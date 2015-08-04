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

    // Commons.activeMenu = "partners";

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
        DTColumnBuilder.newColumn(null).withTitle('Action').renderWith(function(data, type, full, meta) {
                return '<button ng-show="sess.loggedin" onClick="edit_user('+data.id+')">Edit</button><button ng-show="sess.loggedin" onClick="reset_password('+data.id+')">Reset Password</button><button ng-show="sess.loggedin" onClick="Set_password_to('+data.id+')">Set password to</button><button ng-show="sess.loggedin" onClick="ban_user('+data.id+')">Ban User</button>';
            }),
    ];

    edit_user = function(id){
        window.location = "#/editUser/"+id;
    }
    ban_user = function(id){
    }
    reset_password = function(id){
    }
    Set_password_to = function(id){
    }


}]);