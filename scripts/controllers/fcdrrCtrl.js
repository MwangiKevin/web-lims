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
                    year:
                    {
                        // label   : null,
                        // value   : null
                    },
                    month:
                    {
                        // label   : null,
                        // value   : null
                    }
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

        $scope.resetMonth();

        nowNormalized = moment().startOf("month"), 
        startDateNormalized = moment().subtract('month', 3).startOf('month');
        while (startDateNormalized.isBefore(nowNormalized) ) {
            if (startDateNormalized.format("YYYY")== $scope.fcdrr.head_info.selected.dates.year.value){
                $scope.selectableDates.months.push({label : startDateNormalized.format("MMMM"),value : startDateNormalized.format("MM")});
            }
            startDateNormalized.add("M", 1);
        }
    }


    $scope.getSelectableYears =function () {

        // $scope.selectableDates.years=[$scope.selectableDates.years[1]];

        // console.log($scope.selectableDates.years);

        // $scope.fcdrr.head_info.selected.dates.month = $scope.selectableDates.months[1];

        nowNormalized = moment().startOf("month"), 
        startDateNormalized = moment().subtract('month', 3).startOf('month');

        $scope.selectableDates.years.push({label : startDateNormalized.format("YYYY"),value : startDateNormalized.format("YYYY")});

        if(startDateNormalized.format("YYYY")!=nowNormalized.format("YYYY")){
            $scope.selectableDates.years.push({label : nowNormalized.format("YYYY"),value : nowNormalized.format("YYYY")});
        }

        // $scope.fcdrr.head_info.selected.dates.month.value=null;
        $scope.getSelectableMonths();

    }

    $scope.resetMonth = function() {
        // if(angular.isDefined($scope.fcdrr.head_info.selected.dates.month)){
        //     delete $scope.fcdrr.head_info.selected.dates.month
        // }

    }

    $scope.getSelectableYears();
    $scope.getSelectableMonths();


    // $scope.fcdrr.head_info.selected.dates.month = $scope.selectableDates.months[1];


    // $scope.fcdrr.head_info.selected.dates.year = $scope.selectableDates.years[1];

}])
