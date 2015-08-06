app.controller('facilitiesCtrl', ['$scope','$rootScope','$state','Commons', 'Restangular', '$activityIndicator', 'DTOptionsBuilder','DTColumnBuilder','DTColumnDefBuilder','DTInstances','apiAuth', function ($scope,$rootScope,$state,Commons,Restangular,$activityIndicator,DTOptionsBuilder,DTColumnBuilder ,DTColumnDefBuilder,DTInstances,apiAuth ) {

    apiAuth.requireLogin();

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withSource({
        url: Commons.baseURL+'api/facilities',
        data:{datatable:true,verbose:true,filter_type :$rootScope.getFilterType(), filter_id: $rootScope.getFilterId()},
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
    .withColVisOption('aiExclude', [1,2,3,4,5])


    .withOption('responsive', true)

    .withColReorder()
    // .withColReorderOrder([1, 0, 2])
    .withColReorderOption('iFixedColumnsRight', 1)
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
                'sButtonText': '+ New Facility', 
                'fnClick'   : function ( nButton, oConfig, oFlash ) {
                    window.location = "#/newFacility";
                },
                'sButtonText': 'Reload', 
                'fnClick'   : function ( nButton, oConfig, oFlash ) {
                    
                    $state.reload();
                    reloadFacilities();
                }
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('facility_id').withTitle('facility #'),
        DTColumnBuilder.newColumn('facility_mfl_code').withTitle('MFL CODE'),
        DTColumnBuilder.newColumn('facility_email').withTitle('Email'),
        DTColumnBuilder.newColumn('facility_phone').withTitle('Phone'),
        DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
        DTColumnBuilder.newColumn('county_name').withTitle('County'),
        DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county'),
        DTColumnBuilder.newColumn('partner_name').withTitle('Partner'),
        DTColumnBuilder.newColumn('central_site_name').withTitle('Central Site'),        
        DTColumnBuilder.newColumn(null).withTitle('Action').notSortable().renderWith(function(data, type, full, meta) {
                return '<button class="ColVis_Button ColVis_MasterButton" style="height:14px;" ng-show="sess.loggedin" onClick="edit_facility('+data.facility_id+')">Edit</button><button class="ColVis_Button ColVis_MasterButton" style="height:14px;" ng-show="sess.loggedin" onClick="view_facility('+data.facility_id+')">View</button><button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick ="remove_facility('+data.facility_id+')" >Remove</button>';
            }),
    ];
    $scope.dtColumnDefs = [
        // DTColumnDefBuilder.newColumnDef('edit').withTitle('Edit').notSortable()
    ];
    $scope.dtInstance = {};

    reloadFacilities =function () {
        console.log($scope.dtInstance);    
        var resetPaging = false;
        $scope.dtInstance.reloadData(callback, resetPaging);
        // $scope.dtInstance.rerender();
    }
    function callback(json) {
        // console.log(json);
    }

    edit_facility = function(id){
        window.location = "#/editFacility/"+id;
    }
    view_facility = function(id){
        window.location = "#/viewFacility/"+id;
    }

    remove_facility = function(id){ // Deactivate Facility
        //window.location = "#/removeFacility/"+id;
        swal({
            title: "Are you sure?",
            text: "This will mean devices will not be rolled out to this facility",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Deactivate it!",
            closeOnConfirm: false,
        }, function() {
            Restangular.one("facilities", id).remove().then(function() {
                swal("Saved!", "The Facility has been successfully Deactivated", "success");
                $state.transitionTo('Facilities');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });
    }

    $rootScope.$watch('sess.loggedin',function(){

        // $state.reload();
        reloadFacilities();
    })


}]);