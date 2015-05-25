app.factory('Commons', ['$location','apiAuth',function($location,apiAuth){
	var Commons={};
	var activeMenu = "";
	var activeSubmenuLV1 = "";
	var activeSubmenuLV2 = "";
	Commons.showMenu = true;
	Commons.dashboardAreaClass = 'column';
	Commons.title = '';
	Commons.projectName='web-lims';

	Commons.requireNoLogin = function(){

		// $rootScope.$broadcast('event:auth-loginNotRequired');
		apiAuth.requireNoLogin();
	}

	Commons.getActiveMenu = function (name) {
		// console.log(name)
		if(name == Commons.activeMenu){
			return "active shadowed"
		}else{
			return ""
		}
	};
	Commons.baseURL= base_url;
	Commons.getActiveSubmenuLV1 = function (name) {
		if(name == Commons.activeSubmenuLV1){
			return "active shadowed"
		}else{
			return ""
		}

	};
	Commons.getActiveSubmenuLV2 = function (name) {
		if(name == Commons.activeSubmenuLV2){
			return "active shadowed"
		}else{
			return ""
		}

	};
	Commons.getTitle = function () {
		return Commons.title
	};
	Commons.getMenuShowStatus = function () {
		return Commons.showMenu
	};
	Commons.getDashboardAreaClass = function () {
		return Commons.dashboardAreaClass
	};
	Commons.toggleMenu = function () {
		// alert()
		if(Commons.showMenu){
			Commons.showMenu = false;
			Commons.dashboardAreaClass = 'fullpage';
		}else{			
			Commons.showMenu = true;
			Commons.dashboardAreaClass = 'column';
		}

	};

	Commons.getActiveSubmenuLV1 = function(name) {
		if (name == Commons.activeSubmenuLV1) {
			return "active shadowed"
		} else {
			return ""
		}
	}; 

	return Commons;
}])