app.config(['RestangularProvider', function (RestangularProvider){
	RestangularProvider.setBaseUrl('/web-lims/api');
	
    RestangularProvider.setDefaultHttpFields({cache: true});
    // RestangularProvider.setMethodOverriders(["put", "patch"]);
}])