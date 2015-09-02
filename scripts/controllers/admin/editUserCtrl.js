app.controller('editUserCtrl',
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
    'DTInstances',
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth,DTOptionsBuilder,DTColumnBuilder,DTColumnDefBuilder,DTInstances){
     
    apiAuth.requireLogin();

    $scope.user_id = $stateParams.id;

    $scope.filter_group_type = "all";

    $scope.entities = [{ name: '', email:'',phone:'', type: '' }];
    $scope.user_groups=[];

    $scope.back_users = function(){
        window.location = "#/users";
    }

    $scope.user = {};

    $scope.populate_user = function() {
        if ($stateParams.id > 0) {
            var loaded_partner = Restangular.one('users', $stateParams.id);
            loaded_partner.get().then(function(user) {
               $scope.user = user;

                if($scope.user.banned == 0){
                    $scope.banned = false;
                }
                else{
                    $scope.banned = true;
                }
            })
        }
    }

    $scope.$watch('user.default_user_group.group_id', function(){

        if(angular.isUndefined($scope.user.default_user_group)){

        }
        else if($scope.user.default_user_group.group_id == 3 || $scope.user.default_user_group.group_id == 4 ){

            $scope.filter_group_type = "facilities";

        }else if ($scope.user.default_user_group.group_id == 5){

            $scope.filter_group_type = "counties";

        }else if ($scope.user.default_user_group.group_id == 6){

            $scope.filter_group_type = "sub_counties";

        }else if ($scope.user.default_user_group.group_id == 7){

            $scope.filter_group_type = "partners";

        }else{

            $scope.filter_group_type = "none";
        }

        $scope.user.linked_entity = [];

        $scope.refreshEntities("");
       
            
    }, true );

    $scope.$watch('banned', function(){
       
       if($scope.banned){            
            $scope.user.banned = 1;
       }else{

            $scope.user.banned = 0;
       }
            
    }, true );

    $scope.put_user = function() {
        swal({
            title: "Are you sure?",
            text: "This makes changes to this User",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.user.put().then(function(user) {
                swal("Saved!", "Your Changes Have Been Updated", "success");
                $state.transitionTo('users');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });
    }
    $scope.populate_user();

    $scope.refreshEntities = function(search_term) {
        var entity_type = $scope.filter_group_type ;
        Filters.getEntities(search_term,5,entity_type)
        .success(function (ents) {
            $scope.entities = ents;
        })
        .error(function (error) {
            $scope.status = 'Unable to load Filters data: ' + error.message;
        });       
    }
    $scope.refreshEntities("");

    $scope.clear_entity = function($event) {
        $event.stopPropagation(); 
        $scope.user.linked_entity = {filter_type:0,filter_id:0};
    };

    $scope.get_user_groups= function (){
        $http.get(base_url+'api/auth/list_groups')
          .success(function(data, status, headers, config) {

            $scope.user_groups = data;

          });
    }
        
    $scope.get_user_groups();




    $scope.dtOptions = DTOptionsBuilder.newOptions()

    $scope.dtInstance = {};

    $scope.build = function(){
        $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withSource({
            url: Commons.baseURL+'api/report_types',
            data:{user_id:$scope.user_id,datatable:true,verbose:true},
            type: 'GET'
        })
        .withDataProp('data')
        // .withOption('stateSave', true)
        .withOption('processing', true)
        .withOption('serverSide', true)
        .withOption('scrollX', '100%')
        .withPaginationType('full_numbers')

        .withColVis()
        // .withColVisStateChange(stateChange)
        // .withColVisOption('aiExclude', [1,2,3,4,5])


        .withOption('responsive', false)

        .withColReorder()
        // .withColReorderOrder([1, 0, 2])
        .withColReorderOption('iFixedColumnsRight', 1)
        // .withColReorderCallback(function() {
        //         console.log('Columns order has been changed with: ' + this.fnOrder());
        //     })

        // .withTableTools('assets/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf')
        $scope.dtColumns = [
            DTColumnBuilder.newColumn('id').withTitle('#'),
            DTColumnBuilder.newColumn('report_name').withTitle('Name'),
            DTColumnBuilder.newColumn(null).withTitle('Subscribed').renderWith(function(data, type, full, meta) {
                    
                    var subscribed = parseInt(data.subscribed);
                    var rpt_id = parseInt(data.id);


                    if(subscribed==1){                        

                        return '<input type="checkbox" checked  onclick="unsubscribe('+$scope.user_id+','+rpt_id+')">';
                    }else{

                        return '<input type="checkbox"   onclick="subscribe('+$scope.user_id+','+rpt_id+')">';

                    }

                    // return '<button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick="a()">Edit</button>';

                }),,
        ];
    }
    $scope.build();

    $scope.reloadRpts = function () {
        // console.log($scope.dtInstance);          
        $scope.build();  
        var resetPaging = false;
        $scope.dtInstance.reloadData(callback, resetPaging);
        // $scope.dtInstance.rerender();
    }
    function callback(json) {
        // console.log(json);
    }

    $scope.rptSubscribe = function(usr,rpt){

        $scope.reloadRpts();

        return  $http.get(
            'api/reports/subscribe/'+usr+'/'+rpt
            );

    }

    $scope.rptUnsubscribe = function(usr,rpt){

        $scope.reloadRpts();

        return  $http.get(
            'api/reports/unsubscribe/'+usr+'/'+rpt
            );

    }


}]);


function subscribe(usr,rpt){

    angular.element('#userEdit').scope().$apply(function(){
        angular.element('#userEdit').scope().rptSubscribe(usr,rpt);
    })
}

function unsubscribe(usr,rpt){

    angular.element('#userEdit').scope().$apply(function(){
        angular.element('#userEdit').scope().rptUnsubscribe(usr,rpt);
    })
}
