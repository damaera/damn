var app = angular.module('damn-docs', ['ngRoute', 'hc.marked']);

app.config(['markedProvider', function(markedProvider) {
	markedProvider.setOptions({
		gfm: true,
		tables: true,
		highlight: function (code) {
			return hljs.highlightAuto(code).value;
		}
	});
}]);

app.config(['$routeProvider', function ($routeProvider) {
	$routeProvider
		.when('/404', {
			templateUrl: 'views/404.html'
		})
		.when('/', {
			templateUrl: 'views/home.html'
		})
		.when('/docs', {
			redirectTo: '/docs/v0.1/intro/overview'
		})
		.when('/docs/:version/:folder/:page', {
			templateUrl: 'views/docstmp.html',
			controller: 'tmpCtrl'
		})
		.otherwise({
			redirectTo: '/404'
		});
	}]);

app.controller('tmpCtrl', function($scope, $routeParams){

	$scope.menuurl = 'views/docs/'+$routeParams.version + '/menu.html';
	$scope.tmpurl = 'views/docs/'+$routeParams.version + '/' + $routeParams.folder +'/'+ $routeParams.page+ '.md';

});

app.controller('apiCtrl', function($scope, $routeParams){

	$scope.apiurl = 'views/docs/' + $routeParams.version + '/api.md';

});