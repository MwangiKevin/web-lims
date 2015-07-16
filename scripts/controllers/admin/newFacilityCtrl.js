app.controller('newFacilityCtrl',
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
     
    apiAuth.requireLogin(); // This function is run to check if the user has logged in

    $scope.selected = {}; // used for the drop down boxes when user selects a value

    $scope.baseFacilities = Restangular.all('facilities');

    $scope.populateCounty = function(cid) { // fetch the county id and name based on the county id related with the sub county
                var loaded_county = Restangular.one('counties',cid);
                loaded_county.get().then(function(county_load) {
                        $scope.county = county_load;

                        $scope.facility_detail.county_id = $scope.county.id;
                        $scope.facility_detail.county_name = $scope.county.region_name;

                })
    }

    $scope.populateSubcounties = function() { // fetch all sub counties and populate them in the sub counites model
        var loaded_sub_counties = Restangular.all('sub_counties');
        loaded_sub_counties.getList().then(function(sub_county_load) {
           $scope.sub_counties = sub_county_load;
        })
    }

    $scope.populateFtypes = function() { // fetch all facility types and populate them in the facility types model
        var loaded_ftypes = Restangular.all('facility_types');
        loaded_ftypes.getList().then(function(ftypes) {
           $scope.facility_types = ftypes;
        })
    }

    $scope.populateCentralSites = function() { // fetch all facilities and populate them in the central sites model
        var loaded_central_sites = Restangular.all('facilities');
        loaded_central_sites.getList().then(function(list_central_sites) {
           $scope.central_sites = list_central_sites;
        })
    }

    $scope.populatePartners = function() { // fetch all partners and populate them in the partners model
        var loaded_partners = Restangular.all('partners');
        loaded_partners.getList().then(function(partners) {
           $scope.partners = partners;
        })
    }

    $scope.populateRollout = function(){
        $scope.rollouts = [{'id': 1,'name' : 'Yes'},{'id':0,'name' : 'No' }];
    }

    $scope.sub_county_change = function(){ // assign the facility model a county id when the suer select a sub county
            
            $scope.facility_detail.sub_county_id = $scope.selected.sub_county.id; 
            $scope.populateCounty($scope.selected.sub_county.county_id);
    }
    
    $scope.partner_change = function(){ // assign the facility model a partner id
           $scope.facility_detail.partner_id = $scope.selected.partner.id; 
    }

    $scope.central_change = function(){ // assign the facility model a central site id
           $scope.facility_detail.central_site_id = $scope.selected.central.facility_id; 
    }

    $scope.ftype_change = function(){ // assign the facility model a facility type id
           $scope.facility_detail.facility_type_id = $scope.selected.ftype.id; 
    }
    $scope.roll_outchange = function(){
            $scope.facility_detail.rollout_status  = $scope.selected.rollout.id;
    }

    $scope.save_facility = function(){ //save the facility details
        $scope.facility_detail.level = 0;
        $scope.facility_detail.site_prefix  = null;

        swal({
            title: "Are you sure?",
            text:  "This will save "+$scope.facility_detail.name+" as a new facility",
            type:  "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.baseFacilities.post($scope.facility_detail).then(function(facility_detail) {
                swal("Saved!", $scope.facility_detail.name+" has been saved as a new facility ", "success");
                $state.transitionTo('Facilities');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n The facility has not been saved ", "error");
            });
        });
    }


    // run functions defined
    $scope.populatePartners();
    $scope.populateRollout();
    $scope.populateSubcounties();
    $scope.populateCentralSites();
    $scope.populateFtypes();

}])