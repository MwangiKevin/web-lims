app.config(['RestangularProvider', function (RestangularProvider){
	RestangularProvider.setBaseUrl(api_base_url);
	
    RestangularProvider.setDefaultHttpFields({cache: true});
    // RestangularProvider.setMethodOverriders(["put", "patch"]);
}])