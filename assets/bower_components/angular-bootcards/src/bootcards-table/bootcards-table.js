angular.module('bootcards').directive('bootcardsTable', function () {
	return {
		restrict: 'E',
		transclude: true,
		scope: {
			title: '@',
			ngModel: '='
		},
		link: function (scope, element, attrs) {
			console.log('table linked');
		},
		templateUrl: 'bootcards-table/bootcards-table.tmpl.html'
	};
});