app.controller('fcdrrCtrl',
    [
    '$stateParams',
    '$state',
    '$rootScope',
    '$scope',
    '$http',
    'ngProgress', 
    'Filters', 
    'Commons',
    '$activityIndicator',
    'API',
    'SweetAlert', 
    'notify',
    'Restangular',
    'apiAuth',
    function($stateParams,$state, $rootScope,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth){

        // $scope.allowed =  function(){
            
        //     return $http.get("fcdrr/is_allowed");
        // }
        // $scope.is_allowed = $scope.allowed();

        apiAuth.requireLogin();




        $scope.fcdrr_id = $stateParams.id;

        $scope.editState = function(){
            if($stateParams.id>0){
                return 'edit'
            }else{
                return 'new'
            }
        }

        $scope.showMonth = function(){
            var objDate = new Date($scope.fcdrr.from_date);
            locale = "en-us",
            month = objDate.toLocaleString(locale, { month: "long" });
            return month; 
        }
        $scope.showYear = function(){
            var objDate = new Date($scope.fcdrr.from_date);
            locale = "en-us",
            year = objDate.getFullYear();
            return year; 
        }

        Commons.activeMenu = "fcdrr";

        $scope.commodities=[];

        $scope.facilities=[];  

        $scope.status = false;
        $scope.earliest_date = moment().subtract('month', 3).startOf('month');
        $scope.months_back_reporting = 4;

        $scope.promise=null;

        $scope.selectableDates =       {
            years:[],
            months:[]
        }
        $scope.selected =       {
            year:null,
            month:null
        }

        $scope.fcdrr={

            fcdrr_id:null,
            facility_id:null,
            from_date:null,
            to_date:null,
            year:null,
            month:null,
            facility:{},
            calibur_tests_adults:null,
            calibur_tests_pead:null,
            count_tests_adults:null,
            count_tests_pead:null,
            cyflow_tests_adults:null,
            cyflow_tests_pead:null,
            pima_tests:null,
            total_cd4:null,
            adults_bel_cl:null,
            pead_bel_cl:null,
            commodities:{},
            displayed_commodities:{},
            comments:null

        }
        $scope.bind_dates = function(){
            // $.extend($scope.fcdrr.month, $scope.selected.month.value);
            // $.extend($scope.fcdrr.year, $scope.selected.year.value);
            $scope.fcdrr.year   = $scope.selected.year.value;
            $scope.fcdrr.month  = $scope.selected.month.value;
        }

        $scope.reset = function (){

            $scope.fcdrr={

                fcdrr_id:null,
                facility_id:null,
                from_date:null,
                to_date:null,
                year:null,
                month:null,
                facility:{},
                calibur_tests_adults:null,
                calibur_tests_pead:null,
                count_tests_adults:null,
                count_tests_pead:null,
                cyflow_tests_adults:null,
                cyflow_tests_pead:null,
                pima_tests:null,
                total_cd4:null,
                adults_bel_cl:null,
                pead_bel_cl:null,
                commodities:{},
                displayed_commodities:{},
                comments:null

            }

            getFacilities();
            $scope.calculate_total();

        }

        $scope.calculate_total= function(){
            $scope.fcdrr.total_cd4 = 0 ;

            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.calibur_tests_adults))?      0 : parseInt($scope.fcdrr.calibur_tests_adults);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.calibur_tests_pead))?        0 : parseInt($scope.fcdrr.calibur_tests_pead);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.count_tests_adults))?        0 : parseInt($scope.fcdrr.count_tests_adults);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.count_tests_pead))?          0 : parseInt($scope.fcdrr.count_tests_pead);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.cyflow_tests_adults))?       0 : parseInt($scope.fcdrr.cyflow_tests_adults);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.cyflow_tests_pead))?         0 : parseInt($scope.fcdrr.cyflow_tests_pead);
            $scope.fcdrr.total_cd4 +=  isNaN(parseInt($scope.fcdrr.pima_tests))?                0 : parseInt($scope.fcdrr.pima_tests);
        }

        $scope.calculate_total();


        $scope.baseFcdrrs = Restangular.all('fcdrrs');



        $scope.save_fcdrr = function (){

            if($scope.editState()=='new'){
                $scope.post_fcdrr();
            }else if($scope.editState()=='edit'){
                $scope.put_fcdrr();
            }

        }

        $scope.post_fcdrr  = function() {

            swal(
            {   
                title: "Are you sure?",   
                text: "This will permanently save the above FCDRR!",   
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#00b5ad",   
                confirmButtonText: "Yes, Save it!",   
                closeOnConfirm: false,
            },
            function(){    
                $scope.baseFcdrrs.post($scope.fcdrr).then(function(fcdrr){
                    console.log(fcdrr);                    
                    swal("Saved!", "Your Report has been saved", "success");
                    $state.transitionTo('editFCDRR',{id:fcdrr.fcdrr_id});
                    // $state.transitionTo('FCDRRS');
                },function(response){
                     console.log("Error with status code", response);
                      swal("Error!", "An Error was encountered. \n Your Report has not been saved", "error");
                });
            });
        }


        $scope.put_fcdrr  = function() {
             swal(
            {   
                title: "Are you sure?",   
                text: "This make changes to this exixting FCDRR!",   
                type: "info",
                showCancelButton: true,   
                confirmButtonColor: "#00b5ad",   
                confirmButtonText: "Yes, Save it!",   
                closeOnConfirm: false,
            },
            function(){   
                $scope.fcdrr.put().then(function(fcdrr){                 
                    swal("Saved!", "Your Report has been Updated", "success");
                    $state.transitionTo('FCDRRS');
                },function(response){
                     console.log("Error with status code", response);
                      swal("Error!", "An Error was encountered. \n Your Report has not been saved", "error");
                });
            });
        }

        $scope.print = function (){
            swal("Printing!", "Print!", "success");
        }

        $scope.baseFacilities = Restangular.all('facilities');    

        $scope.refreshAddresses = function(search) {
            var params = {address: search, sensor: false};                    

            $scope.baseFacilities.getList({search:search,limit_items:6}).then(function(com) {
                $scope.facilities = com;
            });  

            return  $scope.facilities ;
          };


        /* Start of commodity Details*/

        var baseCommodities = Restangular.all('commodities');
        $activityIndicator.startAnimating();

        $scope.promise =  baseCommodities.getList({fcdrr_format:true,reportingOnly:true}).then(function(com) {
            $scope.commodities = com;
            $activityIndicator.stopAnimating();
        });   

        $scope.promise =  baseCommodities.getList({fcdrr_format:false,reportingOnly:true}).then(function(com) {
            $scope.fcdrr.commodities = com;
        });


        /* End of commodity Details*/



        /* Start of dates*/

        $scope.getSelectableMonths =function () {

            $scope.selectableDates.months=[];


            $scope.selected.month = null;

            nowNormalized = moment().startOf("month"), 
            startDateNormalized = moment().subtract('month', $scope.months_back_reporting).startOf('month');
            while (startDateNormalized.isBefore(nowNormalized) ) {
                if ($scope.selected.year && (startDateNormalized.format("YYYY")== $scope.selected.year.value)){
                    $scope.selectableDates.months.push({label : startDateNormalized.format("MMMM"),value : startDateNormalized.format("MM")});
                }
                startDateNormalized.add("M", 1);
            }
        }


        $scope.getSelectableYears = function () {

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

        $scope.populateFcdrr = function(){

            if($stateParams.id>0){

                var loaded_fcdrr = Restangular.one('fcdrrs',$stateParams.id);

                loaded_fcdrr.get().then(function(fcdrr_load){
                    $scope.fcdrr = fcdrr_load;
                    $scope.calculate_total();
                    $scope.populate_displayed_commodities();
                })
            }

        }
        $scope.validate_fcdrr = function(){

        }
        $scope.populate_displayed_commodities = function(){

            $scope.fcdrr.displayed_commodities={};

            for (i = 0; i < $scope.fcdrr.commodities.length; i++) { 
                $scope.fcdrr.displayed_commodities[$scope.fcdrr.commodities[i].commodity_id]= $scope.fcdrr.commodities[i];
            }
        }

        $scope.populateFcdrr();

    }])
