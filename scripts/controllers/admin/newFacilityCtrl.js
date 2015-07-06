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
    $scope.county = {};

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


    // run functions defined
    $scope.populatePartners(); 
    $scope.populateSubcounties();
    $scope.populateCentralSites();

}])