app.factory('Commons', ['$location',function($location){
	var Commons={};
	var activeMenu = "";
	var activeSubmenuLV1 = "";
	var activeSubmenuLV2 = "";
	Commons.showMenu = true;
	Commons.dashboardAreaClass = 'col span_10_of_12';
	Commons.title = '';
	Commons.projectName='web-lims';

	Commons.getActiveMenu = function (name) {
		// console.log(name)
		if(name == Commons.activeMenu){
			return "active shadowed"
		}else{
			return ""
		}

	};
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
			Commons.dashboardAreaClass = 'col span_12_of_12';
		}else{			
			Commons.showMenu = true;
			Commons.dashboardAreaClass = 'col span_10_of_12';
		}

	};
	return Commons;
}])