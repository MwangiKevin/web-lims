app.factory('Commons', ['$location',function($location){
	var Commons={};
	Commons.showMenu = true;
	Commons.dashboardAreaClass = 'col span_10_of_12';
	Commons.title = 'Summary';

	Commons.getActiveMenu = function (path) {

	};
	Commons.getActiveSubmenu = function (path) {

	};
	Commons.getTitle = function (path) {
		return Commons.title
	};
	Commons.getMenuShowStatus = function (path) {
		return Commons.showMenu
	};
	Commons.getDashboardAreaClass = function (path) {
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