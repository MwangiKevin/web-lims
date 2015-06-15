app.controller('device_distributionCtrl',['$scope', 'Filters', 'Commons','$http',function($scope,Filters,Commons,$http){
	$scope.toggleLoading = function () {
		
		this.device_distribution_stack.loading = !this.device_distribution_stack.loading
		this.cd4_equipment_pie.loading = !this.cd4_equipment_pie.loading
		this.equipment_tests_pie.loading = !this.equipment_tests_pie.loading
		this.expected_reporting_devices.loading = !this.expected_reporting_devices.loading
	}

	//
	//
	//Device Distribution Stacked Bar Graph
	//
	//
	$scope.device_distribution_stack_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_cd4_devices_perCounty"			
			)
		.success(function(response){
			//$scope.cd4_equipment_pie.series[0].data = response;
			 var category = [];
			 var num_of_devices = [];
			 
			 var result = angular.fromJson(response);
			 var count = 0;
			 for (i in result) {
			    if (result.hasOwnProperty(i)) {
			        count++;
			    }
			    category.push(result[i].county);
			    num_of_devices.push(result[i].no_per_county);
			}
			$scope.device_distribution_stack.xAxis.categories = category;
			$scope.device_distribution_stack.series[0].data = num_of_devices; 
		});	
	}
	$scope.device_distribution_stack_data();
	$scope.device_distribution_stack = {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: []
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
            data: []
        }]
	}
	//
	//
	//CD4 Equipment Pie
	//
	//
	$scope.equipment_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_cd4_devices_pie/0/0"			
			)
		.success(function(response){
			$scope.cd4_equipment_pie.series[0].data = response;
			// console.log($scope.cd4_equipment_pie.series[0].data);
		});	
	}
	$scope.equipment_pie_data();
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
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: []
        }]
	}	
	
	//
	//
	//CD4 Equipment and Tests Pie
	//
	$scope.equipment_tests_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_devices_tests_pie/0/0/0/0"			
			)
		.success(function(response){
			$scope.equipment_tests_pie.series[0].data = response;
			// console.log($scope.equipment_tests_pie.series[0].data);
		});	
	}
	$scope.equipment_tests_pie_data();
	$scope.equipment_tests_pie = {
		chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                width: 50
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
                        enabled: false
                    },
                    showInLegend: true
                }
            },
        series: [{
	                type: 'pie',
	                name: 'Percentage',
	                size: '20',
	                data: [{"name":"Alere PIMA","y":0,"sliced":false,"selected":false},{"name":"BD FACS Calibur","y":0,"sliced":false,"selected":false},{"name":"BD Facs Count","y":0,"sliced":false,"selected":false},{"name":"BD Facs Presto","y":0,"sliced":false,"selected":false},{"name":"Cyflow Partec ","y":0,"sliced":false,"selected":false}]
                }]
	}
	
	//
	//
	//Expected Reporting Devices
	//
	$scope.expected_reporting_devices_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_expected_reporting_devices/0/0/0"			
			)
		.success(function(response){
			$scope.expected_reporting_devices.series = response;
			// alert($scope.table_data);
		});	
	}
	$scope.expected_reporting_devices_data();
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
        series: []            
	}
	
	//
	//
	//CD4 Equipment Table
	//
	//
	$scope.cd4_equipment_table = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_devices_table/0/0"			
			)
		.success(function(response){
			$scope.table_data = response;
			// alert($scope.table_data);
		});	
	}
	$scope.cd4_equipment_table();
	
	
	//
	//
	//CD4 Equipment and Tests Table
	//
	//
	$scope.cd4_equipment_tests_table = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_devices_tests_table/0/0/0/0"			
			)
		.success(function(response){
			$scope.equipment_tests_data = response			
		});	
	}
	$scope.cd4_equipment_tests_table();
}])