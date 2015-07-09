app.controller('editFacilityCtrl',
	[
	'$stateParams',
    '$state',
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
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth){
     
    apiAuth.requireLogin();

    $scope.facility_id = $stateParams.id;
    // $scope.promise = null;

     $scope.selected = {}; // used for the drop down boxes when user selects a value

    $scope.backFacilities = function(){
        window.location = "#/facilities";
    }

    $scope.populateFacility_details = function() {
        if ($stateParams.id > 0) {
            var loaded_facility = Restangular.one('facilities', $stateParams.id);
            loaded_facility.get().then(function(facility_load) {
               $scope.facility_detail = facility_load;

               if($scope.facility_detail.facility_rollout_status == 1){
                $scope.facility_detail.status = 'Yes';
               }else{
                 $scope.facility_detail.status = 'No';
               }

            })
        }
    }

   $scope.populateCounty = function(id) {
        if ($stateParams.id > 0) {
            var loaded_county = Restangular.one('counties',id);
            loaded_county.get().then(function(county_load) {
               $scope.county = county_load;

               $scope.facility_detail.county_id = $scope.county.id;
               $scope.facility_detail.county_name = $scope.county.region_name;

            })
        }
    }

    $scope.populateSubcounties = function() {
        if ($stateParams.id > 0) {
            var loaded_sub_counties = Restangular.all('sub_counties');
            loaded_sub_counties.getList().then(function(sub_county_load) {
               $scope.sub_counties = sub_county_load;
            })
        }
    }

    $scope.populateCentralSites = function() { // fetch all facilities and populate them in the central sites model
        var loaded_central_sites = Restangular.all('facilities');
        loaded_central_sites.getList().then(function(list_central_sites) {
           $scope.central_sites = list_central_sites;
        })
    }

    $scope.populateFtypes = function() { // fetch all facility types and populate them in the facility types model
        var loaded_ftypes = Restangular.all('facility_types');
        loaded_ftypes.getList().then(function(ftypes) {
           $scope.facility_types = ftypes;
        })
    }

    $scope.populatePartners = function() {
        if ($stateParams.id > 0) {
            var loaded_partners = Restangular.all('partners');
            loaded_partners.getList().then(function(partners) {
               $scope.partners = partners;
            })
        }
    }

    $scope.populateRollout = function(){
        $scope.rollouts = [{'id': 1,'name' : 'Yes'},{'id':0,'name' : 'No' }];
    }

    $scope.sub_county_change = function(){ // assign the facility model a county id when the suer select a sub county
        
        $scope.facility_detail.facility_sub_county_id = $scope.selected.sub_county.id;
        //$scope.facility_detail.sub_county_name = $scope.selected.sub_county.name; 
        $scope.populateCounty($scope.selected.sub_county.county_id);
    }

    $scope.partner_change = function(){ // assign the facility model a partner id
            $scope.facility_detail.facility_partner_id = $scope.selected.partner.id;
            $scope.facility_detail.partner_name = $scope.selected.partner.name;
             
    }

    $scope.central_change = function(){ // assign the facility model a central site id
           $scope.facility_detail.central_site_id = $scope.selected.central.facility_id;
           //$scope.facility_detail.central_site_name = $scope.selected.central.facility_name; 
    }

    $scope.ftype_change = function(){ // assign the facility model a facility type id
           $scope.facility_detail.facility_type_id = $scope.selected.ftype.id; 
    }
    $scope.roll_outchange = function(){
            $scope.facility_detail.facility_rollout_status  = $scope.selected.rollout.id;
    }

    $scope.put_facility = function() {
        swal({
            title: "Are you sure?",
            text: "This makes changes to this facility details",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.facility_detail.put().then(function(facility_detail) {
                swal("Saved!", "Your Changes Have Been Updated", "success");
               // $state.transitionTo('Facilities');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });

    }

    // run functions defined
    $scope.populateFacility_details();
    $scope.populateRollout();
    $scope.populateSubcounties();
    $scope.populatePartners();
    $scope.populateFtypes();
    $scope.populateCentralSites();

    
}]);