app.controller('cd4DevicesCtrl', ['$scope','Commons', function ($scope,Commons) {

    var firstnames = ['Laurent', 'Blandine', 'Olivier', 'Max'];
    var lastnames = ['Renard', 'Faivre', 'Frere', 'Eponge'];
    var dates = ['1987-05-21', '1987-04-25', '1955-08-27', '1966-06-06'];
    var id = 1;

    Commons.activeMenu = "cd4Devices";

    function generateRandomItem(id) {

        var firstname = firstnames[Math.floor(Math.random() * 3)];
        var lastname = lastnames[Math.floor(Math.random() * 3)];
        var birthdate = dates[Math.floor(Math.random() * 3)];
        var balance = Math.floor(Math.random() * 2000);

        return {
            id: id,
            firstName: firstname,
            lastName: lastname,
            birthDate: new Date(birthdate),
            balance: balance
        }
    }

    $scope.devicesColl = [];

    for (id; id < 90; id++) {
        $scope.devicesColl.push(generateRandomItem(id));
    }

    //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
    $scope.displayedCollection = [].concat($scope.devicesColl);

    //add to the real data holder
    $scope.addRandomItem = function addRandomItem() {
        $scope.devicesColl.push(generateRandomItem(id));
        id++;
    };

    //remove to the real data holder
    $scope.removeItem = function removeItem(row) {
        var index = $scope.devicesColl.indexOf(row);
        if (index !== -1) {
            $scope.devicesColl.splice(index, 1);
        }
    }
}]);