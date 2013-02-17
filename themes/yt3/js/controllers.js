'use strict';

var config = {
  baseUrl: "http://192.168.0.22:8000",
  debug: true
};

var themes = [

{ id: 1, link_to_theme: config.baseUrl + "/app/index.html#/theme/1", title: "One Some lnog title goes here ...", short_desc: "Here some sort of short description", long_desc: "Something so much longer here that can be very very very loooong and nobody can read it blah blah blah...", author: "Author Name", view_cnt: 12349, download_cnt: 564, image: 'http://wpc.4d7d.edgecastcdn.net/004D7D/www/cyberpunk/img/1920x1200_GIRL-CP77.jpg', created_at: "1288323623006", updated_at: "1288323223006" }, 

{ id: 2, link_to_theme: config.baseUrl + "/app/index.html#/theme/2", title: "Two Some lnog title goes here ...", short_desc: "Here some sort of short description", long_desc: "Something so much longer here that can be very very very loooong and nobody can read it blah blah blah...", author: "Author Name", view_cnt: 12349, download_cnt: 564, image: 'http://th04.deviantart.net/fs70/PRE/f/2010/286/f/2/stuart_photographer_by_deviant_bacha-d30os1f.jpg', created_at: "1288323623006", updated_at: "1288323223006" }, 

{ id: 3, link_to_theme: config.baseUrl + "/app/index.html#/theme/3",  title: "Three Some lnog title goes here ...", short_desc: "Here some sort of short description", long_desc: "Something so much longer here that can be very very very loooong and nobody can read it blah blah blah...", author: "Author Name", view_cnt: 12349, download_cnt: 564, image: 'http://th04.deviantart.net/fs70/PRE/f/2010/286/f/2/stuart_photographer_by_deviant_bacha-d30os1f.jpg', created_at: "1288323623006", updated_at: "1288323223006" }, 

{ id: 4, link_to_theme: config.baseUrl + "/app/index.html#/theme/4",  title: "Four Some lnog title goes here ...", short_desc: "Here some sort of short description", long_desc: "Something so much longer here that can be very very very loooong and nobody can read it blah blah blah...", author: "Author Name", view_cnt: 12349, download_cnt: 564, image: 'http://wpc.4d7d.edgecastcdn.net/004D7D/www/cyberpunk/img/1920x1200_GIRL-CP77.jpg', created_at: "1288323623006", updated_at: "1288323223006" }, 

{ id: 5, link_to_theme: config.baseUrl + "/app/index.html#/theme/5",  title: "Five Some lnog title goes here ...", short_desc: "Here some sort of short description", long_desc: "Something so much longer here that can be very very very loooong and nobody can read it blah blah blah...", author: "Author Name", view_cnt: 12349, download_cnt: 564, image: 'http://wpc.4d7d.edgecastcdn.net/004D7D/www/cyberpunk/img/1920x1200_GIRL-CP77.jpg', created_at: "1288323623006", updated_at: "1288323223006" }

];

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
        }
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
      $scope.$parent.showLoader = true;
      $http({ method: "GET", url: YT_CONFIG.apiUrl + "/theme?limit="+limit+"&offset="+offset+"&sort=[{'property':'created','direction':'desc'}]", headers: YT_CONFIG.jsonRestHeaders, data: {limit:limit, offset:offset} }).
        success( function(data, status, headers, config ){
          if ( data.data && data.data.themes ) {
            var themes = data.data.themes;

            // we pair up the themes so we can nicely
            // organize them on the page ...
            var local_themes = themes.slice(0);

            while ( local_themes.length > 0 ) {
              theme_pairs.push( local_themes.splice( 0,2 ) );
            }

            $scope.themes = theme_pairs;
            offset += limit;

            $scope.$parent.showLoader = false;
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
          }
        }).
      error(function(){
          console.log( 'ERR: Ajax failed :/' );
      });
    }
  }
}
ThemeCtrl.$inject = ['$scope', '$route', '$http', '$routeParams'];
