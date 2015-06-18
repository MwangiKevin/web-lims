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
		DTColumnBuilder.newColumn('id').withTitle('Test #'),
		DTColumnBuilder.newColumn('sample').withTitle('Sample/Patient ID'),
		DTColumnBuilder.newColumn('result_date').withTitle('Date'),
		DTColumnBuilder.newColumn('cd4_count').withTitle('CD4 Count'),
		DTColumnBuilder.newColumn('facility_name').withTitle('Facility'),        
        DTColumnBuilder.newColumn('valid').withTitle('Action').renderWith(function(data, type, full, meta) {
        	if(parseInt(data) == 0){
                return 'Not Valid';
            }else{
            	 return 'Valid';

            }
            }),
		DTColumnBuilder.newColumn('device_name').withTitle('Device'),
		DTColumnBuilder.newColumn('device_serial_number').withTitle('Device Serial Num'),
		DTColumnBuilder.newColumn('county_name').withTitle('County'),
		DTColumnBuilder.newColumn('sub_county_name').withTitle('Sub-county').notVisible()
	];

}]);