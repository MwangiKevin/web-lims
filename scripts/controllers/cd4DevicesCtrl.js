app.controller('cd4DevicesCtrl', ['$scope','Commons','Restangular','$activityIndicator','DTOptionsBuilder','DTColumnBuilder',  function ($scope,Commons,Restangular,$activityIndicator,DTOptionsBuilder,DTColumnBuilder) {

 $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withOption('ajax', {
        url: Commons.baseURL+'api/facility_devices',
        data:{datatable:true,verbose:true},
        type: 'GET'
    })  
    .withDataProp('data')
    .withOption('processing', true)
    .withOption('serverSide', true)
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
                'sButtonText': '+ New Device', 
                'fnClick'   : function ( nButton, oConfig, oFlash ) {
                    window.location = "#/newCD4Device";
                }
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('facility_device_id').withTitle('Device #').notVisible(),
        DTColumnBuilder.newColumn('serial_number').withTitle('Serial Number'),
        DTColumnBuilder.newColumn('facility_mfl_code').withTitle('MFL CODE'),
        DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
        DTColumnBuilder.newColumn('facility_email').withTitle('Email'),
        DTColumnBuilder.newColumn('facility_phone').withTitle('Phone'),
        DTColumnBuilder.newColumn('county_name').withTitle('County'),
        DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county').notVisible(),
        DTColumnBuilder.newColumn('partner_name').withTitle('Partner').notVisible(),     
        DTColumnBuilder.newColumn(null).withTitle('Action').notSortable().renderWith(function(data, type, full, meta) {
                return '<button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick="edit_device('+data.facility_id+')">Edit</button><button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick ="remove_device('+data.facility_id+')" >Remove</button>';
            }),


    ];


    edit_device = function(id){
        window.location = "#/editCD4Device/"+id;
    }
    view_device = function(id){
        window.location = "#/viewCD4Device/"+id;
    }
    remove_device = function(id){
        window.location = "#/removeCD4Device/"+id;
    }

}]);