app.controller('cd4TestsCtrl', ['$scope','Commons', 'DTOptionsBuilder','DTColumnBuilder', function ($scope,Commons,DTOptionsBuilder,DTColumnBuilder) {


    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withOption('ajax', {
         // Either you specify the AjaxDataProp here
         // dataSrc: 'data',
         url: Commons.baseURL+'tests/get_sql',
         type: 'POST'
     })
     // or here
     .withDataProp('data')
        .withOption('processing', true)
        .withOption('serverSide', false)
        .withPaginationType('full_numbers');
    $scope.dtColumns = [
        DTColumnBuilder.newColumn('0').withTitle('Test ID'),
        DTColumnBuilder.newColumn('1').withTitle('Sample/Patient ID'),
        DTColumnBuilder.newColumn('2').withTitle('Facility'),
        DTColumnBuilder.newColumn('3').withTitle('CD4 Count'),
        DTColumnBuilder.newColumn('3').withTitle('CD4 Count').notVisible()
    ];

}]);