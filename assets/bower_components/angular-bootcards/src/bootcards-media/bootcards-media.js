angular.module('bootcards').directive('bootcardsMedia', function () {
	return {
		restrict: 'E',
		transclude: true,
		scope: {
			title: '@',
			ngModel: '='
		},
		link: function (scope, element, attrs) {
			console.log('media linked');
		},
		templateUrl: 'bootcards-media/bootcards-media.tmpl.html'
	};
});
