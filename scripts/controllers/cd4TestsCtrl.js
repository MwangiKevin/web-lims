app.controller('cd4TestsCtrl', ['$scope','Commons', 'DTOptionsBuilder','DTColumnBuilder', function ($scope,Commons,DTOptionsBuilder,DTColumnBuilder) {


	$scope.dtOptions = DTOptionsBuilder.newOptions()
	.withOption('ajax', {
		url: Commons.baseURL+'api/tests',
		data:{datatable:true},
		type: 'GET'
	})	
	.withDataProp('data')
	.withOption('processing', true)
	.withOption('serverSide', true)
	.withPaginationType('full_numbers')


    .withColVis()
    // .withColVisStateChange(stateChange)
    .withColVisOption('aiExclude', [0,1])

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
		DTColumnBuilder.newColumn('id').withTitle('Test ID'),
		DTColumnBuilder.newColumn('sample').withTitle('Sample/Patient ID'),
		DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),
		DTColumnBuilder.newColumn('cd4_count').withTitle('CD4 Count'),
		DTColumnBuilder.newColumn('county_name').withTitle('County'),
		DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county').notVisible()
	];

}]);