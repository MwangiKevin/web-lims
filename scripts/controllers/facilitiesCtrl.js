app.controller('facilitiesCtrl', ['$scope','Commons', 'Restangular', '$activityIndicator', 'DTOptionsBuilder','DTColumnBuilder', function ($scope,Commons,Restangular,$activityIndicator,DTOptionsBuilder,DTColumnBuilder ) {

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withOption('ajax', {
        url: Commons.baseURL+'api/facilities',
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
            }
        ]);
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('facility_id').withTitle('facility ID').notVisible(),
        DTColumnBuilder.newColumn('facility_mfl_code').withTitle('MFL CODE'),
        DTColumnBuilder.newColumn('facility_email').withTitle('Email'),
        DTColumnBuilder.newColumn('facility_phone').withTitle('Phone'),
        DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
        DTColumnBuilder.newColumn('county_name').withTitle('County'),
        DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county').notVisible(),
        DTColumnBuilder.newColumn('partner_name').withTitle('Partner').notVisible(),
        DTColumnBuilder.newColumn('central_site_name').withTitle('Central Site').notVisible(),
    ];

}]);