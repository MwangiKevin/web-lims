app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator','API', function($scope,$http,ngProgress,Filters,Commons,$activityIndicator,API){

	Commons.activeMenu = "fcdrr";

	$scope.commodities=[];
	$scope.status = false;
    $scope.earliest_date = moment().subtract('month', 3).startOf('month');

    $scope.selectableDates =
    // {
    //     years:[{label:"*Select a Year*", value: 0}],
    //     months:[{label:"*Select a Month*", value: 0}]
    // }  
    $scope.selectableDates =
    {
        years:[],
        months:[]
    }

    $scope.fcdrr={
    	head_info:
        {
            selected:
            {   
                facility:{},
                dates:
                {
                    year:null,
                    month:null
                }
            }
        },
        devicetests:{},
        comodities:{}
    }

    function getCommodities() {
    	API.getCommodities('',true,true)
    	.success(function (comm) {
    		$scope.commodities = comm;
    	})
    	.error(function (error) {
    		$scope.status = 'Unable to load customer data: ' + error.message;
    	});
    }
    getCommodities();

    $scope.getSelectableMonths =function () {

        $scope.selectableDates.months=[];


        $scope.fcdrr.head_info.selected.dates.month = null;

        nowNormalized = moment().startOf("month"), 
        startDateNormalized = moment().subtract('month', 3).startOf('month');
        while (startDateNormalized.isBefore(nowNormalized) ) {
            if ($scope.fcdrr.head_info.selected.dates.year && (startDateNormalized.format("YYYY")== $scope.fcdrr.head_info.selected.dates.year.value)){
                $scope.selectableDates.months.push({label : startDateNormalized.format("MMMM"),value : startDateNormalized.format("MM")});
            }
            startDateNormalized.add("M", 1);
        }
    }


    $scope.getSelectableYears =function () {

        nowNormalized = moment().startOf("month"), 
        startDateNormalized = moment().subtract('month', 3).startOf('month');

        $scope.selectableDates.years.push({label : startDateNormalized.format("YYYY"),value : startDateNormalized.format("YYYY")});

        if(startDateNormalized.format("YYYY")!=nowNormalized.format("YYYY")){
            $scope.selectableDates.years.push({label : nowNormalized.format("YYYY"),value : nowNormalized.format("YYYY")});
        }

        $scope.getSelectableMonths();

    }

    $scope.getSelectableYears();
    $scope.getSelectableMonths();

}])
