app.controller('facilitiesCtrl', ['$scope','Commons', 'Restangular', function ($scope,Commons,Restangular) {

    Commons.activeMenu = "facilities";

    $scope.facilitiesColl = [];


    
    var baseFacilities = Restangular.all('facilities');

    baseFacilities.getList().then(function(accounts) {
        $scope.facilitiesColl = accounts;
    });
    $scope.facilitiesColl = baseFacilities;

    
    console.log( $scope.allAccounts);


    //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
    $scope.displayedCollection = [].concat($scope.facilitiesColl);

    //add to the real data holder
    $scope.addRandomItem = function addRandomItem(item) {
        $scope.facilitiesColl.push(item);
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