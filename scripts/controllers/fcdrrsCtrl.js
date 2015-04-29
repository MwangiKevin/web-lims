app.controller('fcdrrsCtrl',
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
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular){

        Commons.activeMenu = "fcdrrs";

        $scope.fcdrrsColl = [];

        $scope.promise=null;

        var baseFcdrrs = Restangular.all('fcdrrs');
        $activityIndicator.startAnimating();

        $scope.promise =  baseFcdrrs.getList({verbose:true}).then(function(fc) {
            $scope.fcdrrsColl = fc;
            $activityIndicator.stopAnimating();
        });
        $scope.fcdrrsColl = baseFcdrrs;


        //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
        $scope.displayedCollection = [].concat($scope.fcdrrsColl);

        //add to the real data holder
        $scope.addFacility = function addFacility(fc) {
            $scope.fcdrrsColl.push(fc);
            id++;
        };

        //remove to the real data holder
        $scope.removeItem = function removeItem(row) {
            var index = $scope.fcdrrsColl.indexOf(row);
            if (index !== -1) {
                $scope.fcdrrsColl.splice(index, 1);
            }
        }


    }])
