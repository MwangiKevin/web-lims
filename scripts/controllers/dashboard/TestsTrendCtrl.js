app.controller('TestsTrendCtrl',['$scope', 'Filters',function($scope,Filters){
	$scope.heading = "Turn Around Time"

	$scope.toggleLoading = function () {
		this.testing_trends.loading = !this.testing_trends.loading
		this.tests_vs_errors_pie.loading = !this.tests_vs_errors_pie.loading
		this.yearly_testing_trends.loading = !this.yearly_testing_trends.loading
	}
	
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
            categories: ["Jan,2011","Feb,2011","Mar,2011","Apr,2011","May,2011","Jun,2011","Jul,2011","Aug,2011","Sep,2011","Oct,2011","Nov,2011","Dec,2011","Jan,2012","Feb,2012","Mar,2012","Apr,2012","May,2012","Jun,2012","Jul,2012","Aug,2012","Sep,2012","Oct,2012","Nov,2012","Dec,2012","Jan,2013","Feb,2013","Mar,2013","Apr,2013","May,2013","Jun,2013","Jul,2013","Aug,2013","Sep,2013","Oct,2013","Nov,2013","Dec,2013","Jan,2014","Feb,2014","Mar,2014","Apr,2014","May,2014","Jun,2014","Jul,2014","Aug,2014","Sep,2014","Oct,2014","Nov,2014","Dec,2014","Jan,2015","Feb,2015"],
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
        series: [{"name":"Above critical level","data":[0,0,6,13,23,19,15,48,179,128,22,26,13,8,8,276,871,743,752,1013,1053,1355,1158,1154,1575,1668,1931,2934,3618,130,180,191,1906,2718,2937,2646,3191,3462,4543,4821,5840,8769,5528,6137,9042,7987,5941,4791,4161,1290]},{"name":"Below critical level","data":[3,1,11,15,24,8,20,19,109,154,18,15,8,2,1,254,731,625,789,992,930,1093,1027,957,1450,1477,1693,2714,3347,122,129,189,1583,2154,2459,2308,3021,3057,4165,3965,4928,6421,4231,4694,6788,6386,4596,3609,3092,899],"color":"#caa6bb"}]      
	}
	$scope.yearly_testing_trends = {
		options: {
            chart: {
                type: 'column'
            }
        },
        xAxis: {
                categories: ["2011","2012","2013","2014","2015"]
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
        series: [{"name":"Alere PIMA","data":[510,7941,24421,44248,0]},{"name":"BD Facs Calibur","data":[0,0,0,0,0]},{"name":"BD Facs Count","data":[0,0,0,0,0]},{"name":"Partec Cyflow","data":[0,0,0,0,0]}],
        loading: false
	}

	$scope.tests_vs_errors_pie = {
		chart: {
            renderTo: 'container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Tests & Errors'
        },
        subtitle: {
            text: 'test subtitle'
        },  
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Unsuccessful Tests (Errors)',       14.0],
                ['ABV Critical lvl',   12.0],
                ['BLW Critical lvl',       12.0],
                {
                    name: 'Successful Tests',
                    y: 10.8,
                    sliced: true,
                    selected: true
                },
                ['Errors',    8.5]
            ]
        }]
 	
	}
	
	
}])
