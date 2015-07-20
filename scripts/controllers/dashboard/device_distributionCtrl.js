app.controller('device_distributionCtrl',['$scope', '$rootScope', 'Filters', 'Commons','$http',function($scope, $rootScope, Filters,Commons,$http){
	

	$scope.table_data ={loading:true};
	$scope.equipment_tests_data ={loading:true};

	$scope.toggleLoading = function () {
		
		this.device_distribution_stack.loading = !this.device_distribution_stack.loading
		this.cd4_equipment_pie.loading = !this.cd4_equipment_pie.loading
		this.equipment_tests_pie.loading = !this.equipment_tests_pie.loading
		this.expected_reporting_devices.loading = !this.expected_reporting_devices.loading
		$scope.table_data.loading		=	!$scope.table_data.loading;
		$scope.equipment_tests_data.loading 	=	!$scope.equipment_tests_data.loading;
	}

	
	//	
	//FILTER. Variables plus watch function
	//
	entity_type = '';
	entity_id = '';
	start_date = '';
	end_date = '';


	 $rootScope.$watch('Filters.change_dev', function(){
	 	entity_type = $rootScope.Filters.selected.entity.filter_type;//facility,partener..etc
	 	entity_id = $rootScope.Filters.selected.entity.filter_id; 
	 	start_date = $rootScope.Filters.selected.dates.start;
	 	end_date = $rootScope.Filters.selected.dates.end;
	 	
	 	//redraw the charts
	 	$scope.device_distribution_stack_data();
	 	$scope.equipment_pie_data();
	 	$scope.equipment_tests_pie_data();
	 	$scope.expected_reporting_devices_data();
	 	$scope.cd4_equipment_table();
	 	$scope.cd4_equipment_tests_table();

	 	$scope.toggleLoading();
	});


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
			$scope.device_distribution_stack.loading =false;
		});	
	}
	$scope.device_distribution_stack_data();
	$scope.device_distribution_stack = {
		options: {
	        chart: {
	            type: 'column',
	            borderWidth:2,
	            width:900,
	            height:250
           }
        },
        title: {
            text: 'Device Distribution'
        },
        xAxis: {
            categories: [],
            labels: {
                rotation: -45,
                // step : 3,
                align: "right"
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No of devices'
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
            // x: -30,
            verticalAlign: 'top',
            // y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: true
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
            name:"Devices",
            data: [],
            type: "column",
        }]
	}
	//
	//
	//CD4 Equipment Pie
	//
	//
	$scope.equipment_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_cd4_devices_pie",{
				params:{
					entityType : entity_type,
					entityId : entity_id
				}
			}

			)
		.success(function(response){
			$scope.cd4_equipment_pie.series[0].data = response;
			$scope.cd4_equipment_pie.loading = false;
		});	
	}
	$scope.equipment_pie_data();
	$scope.cd4_equipment_pie = {
        title: {
            text: 'CD4 Equipment',
        },         
        credits:{
            enabled:false
        },
        options: {
        	chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: true,
	            marginTop:0,
	            height:210,
	            width:350,
	            borderWidth:2	            
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
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.y},<b>{point.percentage:.1f}%</b>'
	        },  
	      	legend: {
	            verticalAlign: 'bottom',
	            floating: true,
	            y: 10,
	            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
	            borderColor: '#CCC',
	            borderWidth: 1,
	            shadow: true
	        }
        },
       
        series: [{
            type: 'pie',
            size: '10',
            name: '# Devices',
            data: []
        }]
	}	
	
	//
	//
	//CD4 Equipment and Tests Pie
	//
	$scope.equipment_tests_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_devices_tests_pie",{
				params:{
					entityType : entity_type,
					entityId : entity_id,
					startDate : start_date,
					endDate : end_date	
				}
			})
		.success(function(response){
			$scope.equipment_tests_pie.series[0].data = response;
			$scope.equipment_tests_pie.loading = false;
		});	
	}
	$scope.equipment_tests_pie_data();
	$scope.equipment_tests_pie = {
        title: {
            text: '# of Tests per Equipment'
        },
        options: {
        	chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true,
                marginTop:0,
                width:350,
                height:210,
                borderWidth:2
            },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: false
	                },
	                showInLegend: true,
	                borderWidth:2
	            }
	        }, 
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.y},<b>{point.percentage:.1f}%</b>'
	        },
	      	legend: {
	            // align: 'right',
	            // x: -70,
	            verticalAlign: 'bottom',
	            y: 10,
	            floating: true,
	            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
	            borderColor: '#CCC',
	            borderWidth: 1,
	            shadow: true
	        }
        },
        series: [{
            type: 'pie',
            name: '# of Tests',
            size: '10',
            data: [{"name":"Alere PIMA","y":0,"sliced":false,"selected":false},{"name":"BD FACS Calibur","y":0,"sliced":false,"selected":false},{"name":"BD Facs Count","y":0,"sliced":false,"selected":false},{"name":"BD Facs Presto","y":0,"sliced":false,"selected":false},{"name":"Cyflow Partec ","y":0,"sliced":false,"selected":false}]
        }]
	}
	
	//
	//
	//Expected Reporting Devices
	//
	$scope.expected_reporting_devices_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_expected_reporting_devices",{
				params:{
					entityType : entity_type,
					entityId : entity_id,
					startDate : start_date,
					endDate : end_date	
				}
			})
		.success(function(response){
			$scope.expected_reporting_devices.xAxis.categories = response.categories;
			$scope.expected_reporting_devices.series = response.series;
			$scope.expected_reporting_devices.loading = false;
		});	
	}
	$scope.expected_reporting_devices_data();
	$scope.expected_reporting_devices =  {
		options: {
			chart: { 
	            plotBackgroundColor: null,
	            plotShadow: true,       
	            zoomType: 'x',
	            type: 'area',
	            height:250,
	            width:900,
	            borderWidth: '2'
	           }
        },
        title: {
            text: 'Expected Reporting Devices (Yearly)',
            x: -20 //center   
        },
        xAxis: {
            categories: [],
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
                lineColor: '#515151',
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
			Commons.baseURL+"api/dashboard/get_devices_table",{
				params:{
					entityType : entity_type,
					entityId : entity_id
				}
			})
		.success(function(response){
			$scope.table_data = response;
			$scope.table_data.loading = false;
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
			Commons.baseURL+"api/dashboard/get_devices_tests_table",{
				params:{
					entityType : entity_type,
					entityId : entity_id,
					startDate : start_date,
					endDate : end_date	
				}
			})
		.success(function(response){
			$scope.equipment_tests_data = response;	
			$scope.equipment_tests_data.loading = false;
		});	
	}
	$scope.cd4_equipment_tests_table();
}])