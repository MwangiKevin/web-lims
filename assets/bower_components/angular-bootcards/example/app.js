var app = angular.module('example', [
	'bootcards'
]);

app.controller('MainCtrl', function ($scope) {
	$scope.name = 'World';
	$scope.myListModel = [
		{heading: 'Item 1', text: 'This is the content', image: 'http://bootcards.org/public/images/Sofia%20Acey.jpg'},
		{heading: 'Item 2', text: 'This is the content', image: 'http://bootcards.org/public/images/Joseph%20Barish.jpg'},
		{heading: 'Item 3', text: 'This is the content', image: 'http://bootcards.org/public/images/Sofia%20Acey.jpg'}

	];
});


