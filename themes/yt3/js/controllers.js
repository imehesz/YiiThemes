'use strict';

/* Controllers */

function StaticCtrl( $scope, $routeProvider, $http ) {
  var pageTitle = $routeProvider.current.$route.pageTitle + "" || "";
  $scope.setTitle(  pageTitle );
  $scope.themeMain = {};

  $scope.$parent.showLoader = true;

  // are we on the HOME page?
  if ( pageTitle.toLowerCase().indexOf('home') > -1 ) {
   $http({ method: "GET", url: YT_CONFIG.apiUrl + "/theme/randomfive",headers: YT_CONFIG.jsonRestHeaders }).
      success( function(data, status, headers, config ){
        $scope.$parent.showLoader = false;
        if ( data.data && data.data.totalCount && data.data.totalCount > 0 ) {
          var themes = data.data.themes;
          $scope.themeMain = themes[0];
          $scope.themesTop = [themes[1], themes[2]];
          $scope.themesBottom = [themes[3], themes[4]];

          $scope.$parent.userInfo = data.user_info ? data.user_info : "";
        }
      }).
      error(function(){
        console.log( 'ERR: Ajax failed :/' );
      });
  }

  if ( pageTitle.toLowerCase().indexOf('layouts') > -1 ) {
    $http({ method: "GET", url: YT_CONFIG.apiUrl + "/theme/userinfo",headers: YT_CONFIG.jsonRestHeaders }).
    success( function( data ){
      $scope.$parent.userInfo = data.user_info ? data.user_info : "";
      $scope.$parent.showLoader = false;
    }).
    error(function(){
      console.log( 'ERR: Ajax failed :/' );
    });
  }
}
StaticCtrl.$inject = ['$scope', '$route', '$http'];

function ThemeCtrl( $scope, $routeProvider, $http, $routeParams ) {
  var pageTitle = $routeProvider.current.$route.pageTitle + "" || "";
  $scope.setTitle(  pageTitle );

  $scope.$parent.showLoader = true;

  if ( pageTitle.toLowerCase().indexOf('list') > -1 ) {

    var offset = 0;
    var limit = 4;
    var theme_pairs = [];

    $scope.loadMore = function() {
      // we might have sorting needs ...
      var sort = [{'property':'created','direction':'DESC'}];
      if ( $routeParams.sortby ) {
        if ( $routeParams.sortby == 'views' ) {
          sort = [{'property':'viewed','direction':'DESC'}];
        } else if ( $routeParams.sortby == 'downloads' ) {
          sort = [{'property':'downloaded','direction':'DESC'}];
        }
      }

      // or filtering needs ...
      var filter = [];
      if ( $routeParams.artist ) {
        filter = [{'property':'author', 'value': $routeParams.artist}];
      }

      $scope.$parent.showLoader = true;
      $http({ method: "GET", url: YT_CONFIG.apiUrl + "/theme?limit="+limit+"&offset="+offset+"&sort=" + angular.toJson( sort ) + "&filter=" + angular.toJson( filter ), headers: YT_CONFIG.jsonRestHeaders, data: {limit:limit, offset:offset} }).
        success( function(data, status, headers, config ){
          if ( data.data && data.data.themes ) {
            var themes = data.data.themes;

            // we pair up the themes so we can nicely
            // organize them on the page ...
            var local_themes = themes.slice(0);

            while ( local_themes.length > 0 ) {
              theme_pairs.push( local_themes.splice( 0,2 ) );
            }

            offset += limit;

            $scope.themes = theme_pairs;
            // offset might be too high ... :)
            $scope.themesDisplayedCount = offset < data.data.totalCount ? offset : data.data.totalCount;
            $scope.themesAllCount = data.data.totalCount;
            $scope.$parent.showLoader = false;

            $scope.$parent.userInfo = data.user_info ? data.user_info : "";
          }
        }).
        error(function(){
          console.log( 'ERR: Ajax failed :/' );
        });
    };
    
    $scope.loadMore();
  }

  if ( $routeParams && $routeParams.id ) {
    var id_with_title = $routeParams.id,
      id = id_with_title.substr( 0, id_with_title.indexOf( '-' ) );

    if ( id > 0 ) {
      $http({ method: "GET", url: YT_CONFIG.apiUrl + "/theme/" + id, headers: YT_CONFIG.jsonRestHeaders }).
      success( function(data, status, headers, config ){
          $scope.$parent.showLoader = false;

          if ( data && data.data && data.data.themes ) {
            var theme = data.data.themes;
            $scope.themeMain = theme;
            $scope.setTitle( theme.name );

            $scope.$parent.userInfo = data.user_info ? data.user_info : "";
          }
        }).
      error(function(){
          console.log( 'ERR: Ajax failed :/' );
      });
    }
  }
}
ThemeCtrl.$inject = ['$scope', '$route', '$http', '$routeParams'];
