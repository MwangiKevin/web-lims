app.controller('device_distributionCtrl',['$scope', 'Filters', 'Commons','$http',function($scope,Filters,Commons,$http){
	$scope.toggleLoading = function () {
		
		this.device_distribution_stack.loading = !this.device_distribution_stack.loading
		this.cd4_equipment_pie.loading = !this.cd4_equipment_pie.loading
		this.yearly_testing_trends.loading = !this.yearly_testing_trends.loading
	}
	
	//
	//
	//Device Distribution Stacked Bar Graph
	//
	//
	// $scope.device_distribution_stack();
	$scope.device_distribution_stack = {
		chart: {
            type: 'column'
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'John',
            data: [5, 3, 4, 7, 2]
        }, {
            name: 'Jane',
            data: [2, 2, 3, 2, 1]
        }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5]
        }]
	}
	
	
	//
	//
	//CD4 Equipment Pie
	//
	//
	// $scope.cd4_equipment_pie();
	$scope.cd4_equipment_pie = {
		
	}
	
	//
	//
	//CD4 Equipment Table
	//
	//
	$scope.cd4_equipment_table_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard"			
			)
		.success(function(response){
			$scope.table_data = response;
		});	
	}
	//$scope.cd4_equipment_table_data();
	
	
	//
	//
	//CD4 Equipment and Tests Pie
	//
	//$scope.cd4_equipment_tests_pie();
	$scope.cd4_equipment_tests_pie = {
		
	}
	
	
	//
	//
	//CD$ Equipment and Tests Table
	//
	//
	$scope.cd4_equipment_tests_table_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard"			
			)
		.success(function(response){
			$scope.table_data = response;
		});	
	}
	//$scope.cd4_equipment_tests_table_data();
	
	//
	//
	//Expected Reporting Devices
	//
	//$scope.expected_reporting_devices();
	$scope.expected_reporting_devices =  {
		
	}
	
	
	
	
	
	
	
	
	
}])