app.controller('facilitiesCtrl', ['$scope','Commons', 'Restangular', '$activityIndicator', 'DTOptionsBuilder','DTColumnBuilder','DTColumnDefBuilder', function ($scope,Commons,Restangular,$activityIndicator,DTOptionsBuilder,DTColumnBuilder ,DTColumnDefBuilder ) {

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withOption('ajax', {
        url: Commons.baseURL+'api/facilities',
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
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('facility_id').withTitle('facility ID'),
        DTColumnBuilder.newColumn('facility_mfl_code').withTitle('MFL CODE'),
        DTColumnBuilder.newColumn('facility_email').withTitle('Email'),
        DTColumnBuilder.newColumn('facility_phone').withTitle('Phone'),
        DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
        DTColumnBuilder.newColumn('county_name').withTitle('County'),
        DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county'),
        DTColumnBuilder.newColumn('partner_name').withTitle('Partner'),
        DTColumnBuilder.newColumn('central_site_name').withTitle('Central Site'),        
        DTColumnBuilder.newColumn(null).withTitle('Action').notSortable().renderWith(function(data, type, full, meta) {
                return '<button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick="edit_facility('+data.facility_id+')">Edit</button><button class="ColVis_Button ColVis_MasterButton" style="height:14px;" onClick ="delete_facility('+data.facility_id+')" >Delete</button>';
            }),
    ];
    $scope.dtColumnDefs = [
        // DTColumnDefBuilder.newColumnDef('edit').withTitle('Edit').notSortable()
    ];

    edit_facility = function(id){
        alert('edit'+id);
    }

    delete_facility = function(id){
        alert('delete'+id);
    }


}]);