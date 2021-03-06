'use strict';

String.prototype.prettify = function(){
  var text=this,
    characters = [' ', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '_', '{', '}', '[', ']', '|', '/', '<', '>', ',', '.', '?', '--']; 

  for (var i = 0; i < characters.length; i++) {
    var char = String(characters[i]);
    text = text.replace(new RegExp("\\" + char, "g"), '-');
  }
  text = text.toLowerCase();
  return text;
};

// Declare app level module which depends on filters, and services
angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives']).
  config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/home', {templateUrl: YT_CONFIG.themeUrl + '/partials/home.html', controller: StaticCtrl, pageTitle: "Home"});

    $routeProvider.when('/themes', {templateUrl: YT_CONFIG.themeUrl + '/partials/themes.html', controller: ThemeCtrl, pageTitle: "Theme List" });

    $routeProvider.when('/layouts', {templateUrl: YT_CONFIG.themeUrl + '/partials/layouts.html', controller: StaticCtrl, pageTitle: "Layouts"});

    $routeProvider.when('/theme/:id',{templateUrl: YT_CONFIG.themeUrl + '/partials/theme.html', controller: ThemeCtrl});

    $routeProvider.when('/contact',{templateUrl: YT_CONFIG.themeUrl + '/partials/contact.html', controller: StaticCtrl});

    $routeProvider.otherwise({redirectTo: '/home'});

  }]).run(['$rootScope', function( $rootScope ){
    $rootScope.showLoader = true;
    $rootScope.themeUrl = YT_CONFIG.themeUrl || "";
    $rootScope.setTitle = function( title ) {
      $rootScope.pageTitle = title;
    }

  }]).directive( 'whenScrolled', function(){
    return function ( scope, elm, attr ) {
      var raw = elm[0];

      elm.bind('scroll', function() {
        /*
        // for some unknown reason it stopped working and I had to add +1 
        // now it works, but leaving this here for future reference ...
        console.log( "raw.scrollTop + raw.offsetHeight >= raw.scrollHeight" );
        console.log( raw.scrollTop + raw.offsetHeight + " >= " + raw.scrollHeight );
        */
        if ( raw.scrollTop + raw.offsetHeight+1 >= raw.scrollHeight ) {
          scope.$apply( attr.whenScrolled );
        }
      });
    }
  }).factory(['$rootScope', function($rootScope){
    return $rootScope;
  }]);
