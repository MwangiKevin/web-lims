app.controller('partnersCtrl',
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

    Commons.activeMenu = "partners";

    $scope.partner_id = $stateParams.id;

    $scope.dtOptions = DTOptionsBuilder.newOptions()
    .withOption('ajax', {
        url: Commons.baseURL+'api/partners',
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
        DTColumnBuilder.newColumn('id').withTitle('#'),
        DTColumnBuilder.newColumn('name').withTitle('Partner Name'),
        DTColumnBuilder.newColumn('phone').withTitle('Phone'),
        DTColumnBuilder.newColumn('email').withTitle('Email'),
        DTColumnBuilder.newColumn(null).withTitle('Action').renderWith(function(data, type, full, meta) {
                return '<button onClick="edit_fcdrr('+data.partner_id+')">Edit</button>';
            }),
    ];


}]) 