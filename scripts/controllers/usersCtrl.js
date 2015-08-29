app.controller('usersCtrl',
	[
	'$stateParams',
    '$state',
    '$scope',
    '$http',
    'ngProgress', 
    'Filters', 
    'Commons',
    '$activityIndicator',
    'API',
    'SweetAlert', 
    'notify',
    'Restangular',
    'apiAuth',
    'DTOptionsBuilder',
    'DTColumnBuilder',
    'DTColumnDefBuilder',
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth, DTOptionsBuilder, DTColumnBuilder,DTColumnDefBuilder){
     
    apiAuth.requireLogin();

    // Commons.activeMenu = "users";

    $scope.partner_id = $stateParams.id;

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withOption('ajax', {
        url: Commons.baseURL+'api/users',
        data:{datatable:true,verbose:true},
        type: 'GET'
    })  
    .withDataProp('data')
    .withOption('processing', true)
    .withOption('serverSide', true)
    .withOption('sErrMode', 'throw')
    .withOption('scrollX', '100%')
    .withPaginationType('full_numbers')


    .withColVis()
    // .withColVisStateChange(stateChange)
    // .withColVisOption('aiExclude', [1])


    // .withOption('responsive', true)

    .withColReorder()
    // .withColReorderOrder([1, 0, 2])
    // .withColReorderOption('iFixedColumnsRight', 1)
    // .withColReorderCallback(function() {
    //         console.log('Columns order has been changed with: ' + this.fnOrder());
    //     })

    .withTableTools('assets/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf')
    .withTableToolsButtons([
            'copy',
            'print', {
                'sExtends': 'collection',
                'sButtonText': 'Save',
                'aButtons': ['csv', 'xls', 'pdf']
            },
            {
                'sExtends': 'text',
                'sButtonText': '+ New User', 
                'fnClick'   : function ( nButton, oConfig, oFlash ) {
                    window.location = "#/newUser";
                }
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('id').withTitle('User #'),
        DTColumnBuilder.newColumn('user_name').withTitle('Name'),
        DTColumnBuilder.newColumn('email').withTitle('E-mail'),
        DTColumnBuilder.newColumn('phone').withTitle('Phone').notSortable(),
        DTColumnBuilder.newColumn('banned').withTitle('Status').renderWith(function(data, type, full, meta) {
             if(data==0){
                return "Active";
             }else{                
                return "Banned";
             }

        }),
        DTColumnBuilder.newColumn(null).withTitle('Group').notSortable().renderWith(function(data, type, full, meta) {
              var arr= data.default_user_group;
              arr.constructor 

              if(!(arr instanceof Array)){

                    console.log(arr.name);

                    return arr.name;
              }

        }), 
        DTColumnBuilder.newColumn(null).withTitle('Action').renderWith(function(data, type, full, meta) {
                return '<button ng-show="sess.loggedin" onClick="edit_user('+data.id+')">Edit</button><button ng-show="sess.loggedin" onClick="reset_password('+data.id+',\''+data.user_name+'\')">Reset Password</button><button ng-show="sess.loggedin" onClick="Set_password_to('+data.id+',\''+data.user_name+'\')">Set password to</button>';
            }),
    ];

    edit_user = function(id){
        window.location = "#/editUser/"+id;
    }
    reset_password = function(id,name){

        SweetAlert.swal({   
            title: "Reset Password for :"+name,   
            text: "Are you sure you want to reset the password?<br><s>This will send a confirmation email</s>",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, Reset it!",  
            closeOnConfirm: false 
        }, function(){   
            return $http.post(
                'api/auth/reset_password',
                {
                    id: id,
                    ver_code: ""
                }
            )
            .then(function(response){
                swal("Nice!", "You Have successfully reset the password of:"+name, "success"); 
            },function(response){
                swal("Error!", "Something went wrong", "error"); 
            });
        });
    }
    Set_password_to = function(id,name){

        SweetAlert.swal({   
            title: "Set Password for :"+name,   
            text: "Type the password to be used",   
            type: "input",   
            showCancelButton: true,   
            closeOnConfirm: false,   
            animation: "slide-from-top",   
            inputPlaceholder: "123456" 
        }, function(inputValue){   
            if (inputValue === false) return false;      
            if (inputValue === "") {     
                swal.showInputError("You need to write something!");     
                return false   
            }      

            return $http.post(
                'api/auth/set_password',
                {
                    id: id,
                    password: inputValue
                }
            )
            .then(function(response){
                swal("Success!", "You Have successfully changed the password of:"+name, "success"); 
            },function(response){
                swal("Error!", "Something went wrong", "error"); 
            });
        });
    }


}]);