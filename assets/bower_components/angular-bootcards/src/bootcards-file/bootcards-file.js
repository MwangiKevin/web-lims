angular.module('bootcards').directive('bootcardsFile', function () {
	return {
		restrict: 'E',
		transclude: true,
		scope: {
			title: '@',
			ngModel: '='
		},
		link: function (scope, element, attrs) {
			console.log('file linked');
		},
		templateUrl: 'bootcards-file/bootcards-file.tmpl.html'
	};
});
