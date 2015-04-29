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
        // subtitle: {
        //     text: 'Source: WorldClimate.com',
        //     x: -20
        // },
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
            //pointFormat: '<br/><br/>{series.name}: <div><b>{point.y}, </b><b>{point.percentage:.1f}%</b></div>'
        },
        series: []  
	}
	
	//
	//
	//YEAERLY TESTING TRENDS
	//
	//
	
	//xAxis yearlt testing trends column grpah categories
	$scope.yearly_testing_trends_categories = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/return_yearly_testing_trends_categories"			
			)
		.success(function(response){
			$scope.yearly_testing_trends.xAxis.categories= response;
		});	
	}
	$scope.yearly_testing_trends_categories();
	
	//series yearly testing trends column graph
	$scope.yearly_testing_trends_series = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/yearly_testing_trends/0/0"			
			)
		.success(function(response){
			$scope.yearly_testing_trends.series = response;
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
		// Build the data arrays
    var testsData = [];
    var testsTypeData = [];
	$scope.tests_vs_errors_pie_data = function(){
		return $http.get(
			Commons.baseURL+"api/dashboard/test_errors_pie"			
			)
		.success(function(response){
			data = response;
			categories = ['Successful Tests','Unsuccessful Tests (Errors)'];
			
			console.log(categories);
    		console.log(data);
    		
			// for (var i = 0; i < data.length; i++) {
//     
            // // add browser data
            // testsData.push({
                // name: categories[i],
                // y: data[i].y,
                // color: data[i].color
            // });
//     
            // // add version data
            // for (var j = 0; j < data[i].drilldown.data.length; j++) {
                // var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                // testsTypeData.push({
                    // name: data[i].drilldown.categories[j],
                    // y: data[i].drilldown.data[j],
                    // color: Highcharts.Color(data[i].color).brighten(brightness).get()
                // });
            // }
        // }
		// $scope.tests_vs_errors_pie.series.data = response;
			$scope.tests_vs_errors_pie.series[0].data = response;
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
                text: 'Tests vs Errors'
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
                data: []
            }]
		// chart: {
            // plotBackgroundColor: null,
            // plotBorderWidth: null,
            // plotShadow: true, 
            // type: 'pie',
            // height: '195'
        // },
        // title: {
            // text: 'Tests VS Errors'
        // },
        // yAxis: {
            // title: {
                // text: ''
            // }
        // },
        // credits:{
            // enabled:false
        // }, 
        // plotOptions: {
            // pie: {
                // shadow: false,
                // center: ['50%', '50%'],
                // showInLegend: true,
                // allowPointSelect: true,
                // cursor: 'pointer',
                // dataLabels: {
                    // enabled: false
                // },
            // }
        // },
        // tooltip: {
            // valueSuffix: '',
            // pointFormat: '<b>{series.name}</b>: <div><b>{point.y}, </b><br/>Percentage Share: <b>{point.percentage:.2f}%</b></div>'
        // },
        // series: [{
            // name: '#',
            // data: "Successful Tests, Unsuccessful Tests (Errors)",
            // size: '100%',
            // dataLabels: {
                // formatter: function() {
                    // return this.y > 0 ? this.point.name : null ;
                // },
                // color: 'white',
                // distance: -30
            // }
        // }, {
            // name: '#',
            // data: testsTypeData,
            // size: '230%',
            // innerSize: '200%',
            // dataLabels: {
                // formatter: function() {
                    // // display only if larger than 1
                    // return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +' ('+Math.round(this.percentage,2)+' %)'  : null;
                // }
            // }
        // }]
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
