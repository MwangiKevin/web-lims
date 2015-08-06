app.controller('fcdrrsCtrl',
    [
    '$stateParams',
    '$state',
    '$scope',
    '$rootScope',
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
    function($stateParams,$state,$scope,$rootScope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth, DTOptionsBuilder, DTColumnBuilder,DTColumnDefBuilder){

    apiAuth.requireLogin();      

    Commons.activeMenu = "fcdrrs";
    function get_ajax_source(){
            return {
            url: Commons.baseURL+'api/fcdrrs',
            data:{datatable:true,verbose:true,filter_type :$rootScope.getFilterType(), filter_id: $rootScope.getFilterId()},
            type: 'GET'
        }
    }

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withSource(get_ajax_source())
    .withDataProp('data')    
    .withOption('stateSave', false)
    .withOption('processing', true)
    .withOption('serverSide', true)
    .withOption('scrollX', '100%')
    .withPaginationType('full_numbers')

    .withColVis()
    // .withColVisStateChange(stateChange)
    .withColVisOption('aiExclude', [1])


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
                'sButtonText': 'Reload', 
                'fnClick'   : function ( nButton, oConfig, oFlash ) {
                    // $state.reload();
                    reloadFcdrrs();
                }
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('fcdrr_id').withTitle('FCDRR #'),
        DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
        DTColumnBuilder.newColumn('facility_mfl_code').withTitle('MFL CODE'),
        DTColumnBuilder.newColumn(null).withTitle('Commodities reported for').renderWith(function(data, type, full, meta) {
            return  data.commodities.length;
        }),
        DTColumnBuilder.newColumn('from_date').withTitle('Start Date'),
        DTColumnBuilder.newColumn('to_date').withTitle('End Date'),
        DTColumnBuilder.newColumn(null).withTitle('Action').renderWith(function(data, type, full, meta) {
                return '<button onClick="edit_fcdrr('+data.fcdrr_id+')">Edit</button>';
            }),
    ];

    $scope.dtInstance = {};

    reloadFcdrrs = function () {
        console.log($scope.dtInstance);    
        // alert($rootScope.getFilterType())
        var resetPaging = true;
        $scope.dtInstance.reloadData(callback, resetPaging);
        $scope.dtInstance.rerender();
    }

    function callback(json) {
        // console.log(json);
    }

    edit_fcdrr = function(id){        
        window.location = "#/editFCDRR/"+id;
    }

    $rootScope.$watch('sess.loggedin',function(){

        // $state.reload();
        reloadFcdrrs();
    })

}])
