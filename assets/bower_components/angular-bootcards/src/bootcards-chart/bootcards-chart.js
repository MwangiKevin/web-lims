angular.module('bootcards').directive('bootcardsChart', function () {
	return {
		restrict: 'E',
		transclude: true,
		scope: {
			title: '@',
			ngModel: '='
		},
		link: function (scope, element, attrs) {
			console.log('chart linked');
			var drawCharts = function () {

				/*
				Morris.Bar({
					element: 'barChart',
					data: [
						{person: 'Guy Bardsley', sales: 550},
						{person: 'Adam Callahan', sales: 1500},
						{person: 'Arlo Geist', sales: 3750},
						{person: 'Sheila Hutchins', sales: 3500}
					],
					xkey: 'person',
					ykeys: ['sales'],
					labels: ['Sales'],
					hideHover: 'auto'
				});
				*/
			}
			$(document).ready(function () {
				drawCharts();
			});
			$(window).on('resize', function () {
				drawCharts();
			});
		},
		templateUrl: 'bootcards-chart/bootcards-chart.tmpl.html'
	};
});
