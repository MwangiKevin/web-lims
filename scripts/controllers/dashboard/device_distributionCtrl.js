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
		 chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'CD4 Equipment'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
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
	$scope.equipment_tests_pie = {
		chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'CD4 Tests & Equipment'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
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
		chart: { 
            plotBackgroundColor: null,
            plotBorderWidth: 2,
            plotShadow: true,       
            zoomType: 'x',
            type: 'area',
            height:250
        },
        title: {
            text: 'Expected Reporting Devices (Year <?php echo $year;?>)',
            x: -20 //center   
        },
        xAxis: {
            categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            labels: {
                rotation: -45,
                step : 0,
                align: "right"
            }
        },
        yAxis: {
            title: {
                text: '# Pima Devices'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
            area: {
                stacking: null,
                lineColor: '#666666',
                lineWidth: 1,                       
                marker: {
                    lineWidth: 0,
                    lineColor: '#666666',
                    radius: 0
                }               
            }            
        },            
        credits:{
            enabled:false
        },
        tooltip: {
            shared: true,
            valueSuffix: ' Devices',
            crosshairs: [true,false],
            //pointFormat: '<br/><br/>{series.name}: <div><b>{point.y}, </b><b>{series.data.percentage:.1f}%</b></div>'
        },
        series: [{"name":"Expected Reporting Devices","data":[3,4,7,12,16,19,20,24,26,31,38,40]},{"name":"Reported Devices","color":"#a4d53a","data":[null,null,null,null,null,null,null,null,null,null,null,null]}]            
	}
	
	
	
	
	
	
	
	
	
}])