app.controller('facilitiesCtrl', ['$scope','Commons', 'Restangular', '$activityIndicator', function ($scope,Commons,Restangular,$activityIndicator ) {

    Commons.requireNoLogin();

    Commons.activeMenu = "facilities";

    $scope.facilitiesColl = [];

    $scope.promise=null;
    
    var baseFacilities = Restangular.all('facilities');
    $activityIndicator.startAnimating();
    
    $scope.promise =  baseFacilities.getList({verbose:true}).then(function(fac) {
        $scope.facilitiesColl = fac;
        $activityIndicator.stopAnimating();
    });
    $scope.facilitiesColl = baseFacilities;


    //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
    $scope.displayedCollection = [].concat($scope.facilitiesColl);

    //add to the real data holder
    $scope.addFacility = function addFacility(fac) {
        $scope.facilitiesColl.push(fac);
        id++;
    };

    //remove to the real data holder
    $scope.removeItem = function removeItem(row) {
        var index = $scope.facilitiesColl.indexOf(row);
        if (index !== -1) {
            $scope.facilitiesColl.splice(index, 1);
        }
    }
}]);