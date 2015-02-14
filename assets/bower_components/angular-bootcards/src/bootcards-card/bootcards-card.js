angular.module('bootcards').directive('bootcardsCard', function () {
	return {
		restrict: 'E',
		transclude: true,
		scope: {
			title: '@',
			ngModel: '='
		},
		link: function (scope, element, attrs) {
			console.log('card linked');
		},
		templateUrl: 'bootcards-card/bootcards-card.tmpl.html'
	};
});