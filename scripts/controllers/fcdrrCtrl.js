app.controller('fcdrrCtrl',
    [
    '$scope',
    '$http',
    'ngProgress', 
    'Filters', 
    'Commons',
    '$activityIndicator',
    'API',
    'SweetAlert', 
    'notify',
    function($scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify){

     Commons.activeMenu = "fcdrr";

     $scope.commodities=[];

     $scope.facilities=[];  

     $scope.status = false;
     $scope.earliest_date = moment().subtract('month', 3).startOf('month');
     $scope.months_back_reporting = 4;

     $scope.promise=null;

// SweetAlert.swal("Here's a message");
// SweetAlert.swal("Good job!", "You clicked the button!", "success");

// notify('Your notification message');

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
        devicetests:{

            facs_calibur:{
                paed_tests:null,
                adult_tests:null
            },
            facs_count:{
                paed_tests:null,
                adult_tests:null
            },
            cyflow:{
                paed_tests:null,
                adult_tests:null
            },
            pima:{
                pima_tests:null
            },
            total_cd4:0,
            total_adults_under_500:null,
            total_pead_under_500:null,
        },
        comodities:{}
    }

    $scope.calculate_total= function(){
        $scope.fcdrr.devicetests.total_cd4 = 0 ;

        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.facs_calibur.paed_tests))? 0 : parseInt($scope.fcdrr.devicetests.facs_calibur.paed_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.facs_calibur.adult_tests))?0 : parseInt($scope.fcdrr.devicetests.facs_calibur.adult_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.facs_count.paed_tests))? 0 : parseInt($scope.fcdrr.devicetests.facs_count.paed_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.facs_count.adult_tests))?0 : parseInt($scope.fcdrr.devicetests.facs_count.adult_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.cyflow.paed_tests))? 0 : parseInt($scope.fcdrr.devicetests.cyflow.paed_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.cyflow.adult_tests))?0 : parseInt($scope.fcdrr.devicetests.cyflow.adult_tests);
        $scope.fcdrr.devicetests.total_cd4 +=  isNaN(parseInt($scope.fcdrr.devicetests.pima.pima_tests))?0 : parseInt($scope.fcdrr.devicetests.pima.pima_tests);
    }

    $scope.calculate_total();


    /* Start of facility Details*/

    function getFacilities() {

        $scope.promise = API.getFacilities()
        .success(function (fac) {
            $scope.facilities = fac;
            $scope.fcdrr.head_info.selected.facility = $scope.facilities[0];  //this is just a test 
        })
        .error(function (error) {
            $scope.status = 'Unable to load customer data: ' + error.message;
        });
    }
    getFacilities();

    /* End of facility Details*/




    /* Start of facility Details*/
    function getCommodities() {
     $scope.promise = API.getCommodities('',true,true)
     .success(function (comm) {
      $scope.commodities = comm;            
  })
     .error(function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
  });
 }
 getCommodities();


 /* End of facility Details*/



 /* Start of dates*/

 $scope.getSelectableMonths =function () {

    $scope.selectableDates.months=[];


    $scope.fcdrr.head_info.selected.dates.month = null;

    nowNormalized = moment().startOf("month"), 
    startDateNormalized = moment().subtract('month', $scope.months_back_reporting).startOf('month');
    while (startDateNormalized.isBefore(nowNormalized) ) {
        if ($scope.fcdrr.head_info.selected.dates.year && (startDateNormalized.format("YYYY")== $scope.fcdrr.head_info.selected.dates.year.value)){
            $scope.selectableDates.months.push({label : startDateNormalized.format("MMMM"),value : startDateNormalized.format("MM")});
        }
        startDateNormalized.add("M", 1);
    }
}


$scope.getSelectableYears =function () {

    nowNormalized = moment().startOf("month"), 
    startDateNormalized = moment().subtract('month', $scope.months_back_reporting).startOf('month');

    $scope.selectableDates.years.push({label : startDateNormalized.format("YYYY"),value : startDateNormalized.format("YYYY")});

    if(startDateNormalized.format("YYYY")!=nowNormalized.format("YYYY")){
        $scope.selectableDates.years.push({label : nowNormalized.format("YYYY"),value : nowNormalized.format("YYYY")});
    }

    $scope.getSelectableMonths();

}

$scope.getSelectableYears();
$scope.getSelectableMonths();

/* End of dates*/

}])
