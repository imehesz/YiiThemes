<?php $this->pageTitle = 'Theme Browser'; ?>
<header class="jumbotron subhead" id="overview">
  <div class="row">
    <div class="span12">
      <h1>
        Theme Browser
        <div class="pull-right">
          <!-- AddThis Button BEGIN -->
          <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=ra-4dc48dcc77246178"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dc48dcc77246178"></script>
          <!-- AddThis Button END -->        
        </div>
      </h1>
    </div>
  </div> <!-- .row -->
  <div class="subnav subnav-themes">
    <ul class="nav nav-pills">
      <li class=""> <a href="<?php echo $this->createUrl( '/theme/index', array( 'sort' => 'created.desc') ); ?>">Latest</a> </li>
      <li class=""> <a href="<?php echo $this->createUrl( '/theme/index', array( 'sort' => 'viewed.desc') ); ?>">Most Viewed</a> </li>
      <li class=""> <a href="<?php echo $this->createUrl( '/theme/index', array( 'sort' => 'downloaded.desc') ); ?>">Most Downloaded</a> </li>
      <!-- 
      TODO implement this ...
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">Artists <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="">Artis #1</a><li>
          <li><a href="">Artis #2</a><li>
          <li><a href="">Artis #3</a><li>
          <li><a href="">Artis #4</a><li>
        </ul>
      </li>
      -->
    </ul>
  </div>
</header>

<div>
  <?php 
    $themes = $dataProvider->getData();
    if ( sizeof( $themes ) ) :
  ?>
		<?php 
      $cur_col = 1; 
      $cur_theme = 0; 
      $themes_cnt = sizeof( $themes ); 

      for( $i=0; $i<$themes_cnt; $i++ ) : 
    ?>
      <?php if ( $cur_col == 1 ) : ?>
        <div class="row">
      <?php endif; ?>

      <?php // we only mess around with the ads, if we have the full amount of themes displaying ?>
      <?php if ( $themes_cnt == $dataProvider->pagination->getLimit() ) : ?>
        <?php if ( in_array($i, $ad_slots ) ) : ?>
          <div class="span6 ad-content">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-1319358860215477";
            /* Theme Factory - Theme List (block) */
            google_ad_slot = "8181023972";
            google_ad_width = 336;
            google_ad_height = 280;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
          </div>
          <?php if ( $cur_col == 2 ) : ?>
            </div>
            <div class="row">
          <?php $cur_col = 0; endif; ?>
        <?php $cur_col++; endif; ?>
      <?php endif; ?>

      <?php $theme = $themes[$i]; ?>
      <div class="span6 small-theme" title="<?php echo $theme->name; ?>">
        <a href="<?php echo $this->createUrl( '/theme/view', array( 'id' => $theme->id, 'title' => $this->makeMePretty( $theme->name ) ) ); ?>"><img src="/image.php?width=570&height=320&cropratio=570:320&image=/files/screenshots/<?php echo $theme->preview1; ?>"></a>
        <div class="small-theme-caption">
          <h5><a href="<?php echo $this->createUrl( '/theme/view', array( 'id' => $theme->id, 'title' => $this->makeMePretty( $theme->name ) ) ); ?>"><?php echo $theme->name; ?></a><span class="by-whom"> by <a href="<?php echo $this->createUrl( '/theme/index', array( 'artist' => $theme->user->username ) ); ?>"><?php echo $theme->user->username; ?></a></span></h5>
        </div>
      </div>

      <?php if ( $cur_col == 2 ) : ?>
        </div> <!-- end .row  normal -->
      <?php $cur_col = 0; endif; ?>
    <?php $cur_col++; $cur_theme++; endfor; ?>
  <?php endif; ?>

  <div class="row">
    <div class="span12" style="text-align:center;">
      <div class="pagination">
      <?php 
        $this->widget( 
          'CLinkPager', 
          array(
            'pages'   => $dataProvider->pagination, 
            'cssFile' => false, 
            'internalPageCssClass' => '',
            'selectedPageCssClass' => 'active',
            'header' => ''
          )
        ); 
       ?>
      </div>
    </div>
  </div>
</div>

<script>
(function ($) {
	$(function(){

		// fix sub nav on scroll
		var $win = $(window),
				$nav = $('.subnav'),
				navHeight = $('.navbar').first().height(),
				navTop = $('.subnav').length && $('.subnav').offset().top - navHeight,
				isFixed = 0;

		processScroll();

		$win.on('scroll', processScroll);

		function processScroll() {
			var i, scrollTop = $win.scrollTop();
			if (scrollTop >= navTop && !isFixed) {
				isFixed = 1;
				$nav.addClass('subnav-fixed');
			} else if (scrollTop <= navTop && isFixed) {
				isFixed = 0;
				$nav.removeClass('subnav-fixed');
			}
		}
	});
})(window.jQuery);
</script>
