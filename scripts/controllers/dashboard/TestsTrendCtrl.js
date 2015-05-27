app.controller('TestsTrendCtrl',['$scope', 'Filters', 'Commons','$http',function($scope,Filters,Commons,$http){
	$scope.toggleLoading = function () {
		
		this.testing_trends.loading = !this.testing_trends.loading
		this.tests_vs_errors_pie.loading = !this.tests_vs_errors_pie.loading
		this.yearly_testing_trends.loading = !this.yearly_testing_trends.loading
	}
	//
	//
	//TESTING TRENDS LAST 4 YEARS
	//
	//
	
	//yAxis data line grpah[4yrs]
	$scope.testing_trends_linegraph_series = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_testing_trends/0/0"			
			)
		.success(function(response){
			$scope.testing_trends.series= response;
		});	
	}
	$scope.testing_trends_linegraph_series();
	
	//categoreis for line graph xAxis [4yrs]
	$scope.testing_trends_linegraph_categories =function(){
 		return $http.get(
			Commons.baseURL+"api/dashboard/return_testing_trends_categories"			
			)
		.success(function(response){
			$scope.testing_trends.xAxis.categories= response;
		});
	}
	$scope.testing_trends_linegraph_categories();	
	 
	$scope.testing_trends = {
		chart: {   
                plotBackgroundColor: null,
                plotBorderWidth: 2,
                plotShadow: true,    
                zoomType: 'x',
                type: 'area',
                height:250
        },
        title: {
            text: 'Testing Trends (last 4 years)',
            x: -20 //center   
        },
        xAxis: {
            categories: [],
            labels: {
                rotation: -45,
                step : 3,
                align: "right"
            }
        },
        yAxis: {
            gridLineWidth: 2,
            title: {
                text: '# Tests'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
            area: {
                stacking: 'percentage',
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
            valueSuffix: ' Tests',
            crosshairs: [true,false],
        },
        series: []  
	}
	
	//
	//
	//YEAERLY TESTING TRENDS
	//
	//	
	//series yearly testing trends column graph
	$scope.yearly_testing_trends_series = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/return_yearly_testing_trends_categories/0/0"			
			)
		.success(function(response){
			$scope.yearly_testing_trends.xAxis.categories= response[0];
			$scope.yearly_testing_trends.series = response[1];
		});	
	}
	$scope.yearly_testing_trends_series();
	
	//chart definition
	$scope.yearly_testing_trends = {
		options: {
            chart: {
                type: 'column'
            }
        },
        xAxis: {
                categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: ' # Tests'
            }
        },
        
        series: [{
            data: [10, 15, 12, 8, 7]
        }],
        title: {
            text: 'Yearly Testing Trends'
        },
        tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
        plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
        series: [],
        loading: false
	}

	//
	//
	//Tests vs Errors pie chart
	//
	//
	
	//series data tests_vs_errors_pie
    var data ="[";
	$scope.tests_vs_errors_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/test_errors_pie"			
			)
		.success(function(response){
			console.log(response);
			// for (var i = 0; i < response.length; i++) {
// 						
				// data += '["'+response[i].name +'",'+response[i].value+'],';
			// }
			// data = data.slice(1,-1);
			// data = angular.toJson(response);
			// console.log(data);
			// console.log(data);	
			
			$scope.tests_vs_errors_pie.series[0].data = response
		});	
	}
	$scope.tests_vs_errors_pie_data();
	//chart definition
	$scope.tests_vs_errors_pie = {
		   chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Test vs Errors'
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
            data: [["failed",200],["passed",400],["total",45721],["errors",3678],["valid",42043]]
        }]
	}

	//
	//
	//Tests table
	//
	//
	$scope.critical_table = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/get_tests/0/0/0/0"			
			)
		.success(function(response){
			$scope.table_data = response;
			// alert($scope.table_data);
		});	
	}
	$scope.critical_table();
}])
