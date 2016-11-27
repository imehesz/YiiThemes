<?php $this->pageTitle = 'Home'; ?>
<header class="jumbotron subhead" id="overview">
  <div class="row">
    <div class="span12">
      <h1>Laravel Theme Factory</h1>
    </div>
  </div>
</header>
<div class="row">
  <div class="span12">
    <div class="main-theme">
      <a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[0]->id, 'title' => Controller::makeMePretty( $random_five[0]->name ) ) ); ?>"><img src="/image.php?width=1170&height=658&cropratio=1170:658&image=/files/screenshots/<?php echo $random_five[0]->preview1; ?>"></a>
      <div class="span3">
        <div class="main-theme-caption">
          <h3><?php echo $random_five[0]->name; ?></h3>
          <p>
            <?php echo $random_five[0]->short_desc; ?>
          </p>
          <div>
            <div class="label">Author</div> <a href="<?php echo Yii::app()->controller->createUrl( '/theme/index', array( 'artist' => $random_five[0]->user->username ) ); ?>"><?php echo $random_five[0]->user->username ?></a>
          </div>
          <div>
            <div class="label">Viewed</div> <?php echo number_format( $random_five[0]->viewed ); ?>
          </div>
          <div>
            <div class="label">Downloaded</div> <?php echo number_format( $random_five[0]->downloaded ); ?>
          </div>
          <p>
            <div>
              <a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[0]->id, 'title' => Controller::makeMePretty( $random_five[0]->name ) ) ); ?>" class="btn btn-warning btn-small">View Theme</a>
            </div>
          </p>
        </div>
      </div> <!-- .span3 -->
      <div class="main-theme-bottom-caption">
        <h5><a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[0]->id, 'title' => Controller::makeMePretty( $random_five[0]->name ) ) ); ?>"><?php echo $random_five[0]->name; ?></a><span class="by-whom"> by <a href="<?php echo Yii::app()->controller->createUrl( '/theme/index', array( 'artist' => $random_five[0]->user->username ) ); ?>"><?php echo $random_five[0]->user->username; ?></a></span></h5>
      </div> <!-- .main-theme-bottom-caption -->
    </div> <!-- .main-theme -->
  </div> <!-- .span12 -->
</div> <!-- .row -->

<div class="row">
  <div class="span12">
    <div class="ad-content">
      <script type="text/javascript"><!--
      google_ad_client = "ca-pub-1319358860215477";
      /* Theme Factory - Home - Big */
      google_ad_slot = "2915049579";
      google_ad_width = 728;
      google_ad_height = 90;
      //-->
      </script>
      <script type="text/javascript"
      src="//pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
    </div>
  </div>
</div>

<div class="row">
  <?php for ( $i = 1; $i < 3 ; $i++ ) : ?>
    <div class="span6 small-theme">
      <a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[$i]->id, 'title' => Controller::makeMePretty( $random_five[$i]->name ) ) ); ?>"><img src="/image.php?width=570&height=320&cropratio=570:320&image=/files/screenshots/<?php echo $random_five[$i]->preview1 ?>"></a>
      <div class="small-theme-caption">
        <h5><a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[$i]->id, 'title' => Controller::makeMePretty( $random_five[$i]->name ) ) ); ?>"><?php echo $random_five[$i]->name; ?></a><span class="by-whom"> by <a href="<?php echo Yii::app()->controller->createUrl( '/theme/index', array( 'artist' => $random_five[$i]->user->username ) ); ?>"><?php echo $random_five[$i]->user->username; ?></a></span></h5>
      </div>
     </div>
   <?php endfor; ?>
</div>

<div class="row">
  <div class="span6">
    <div class="ad-content">
      <script type="text/javascript"><!--
      google_ad_client = "ca-pub-1319358860215477";
      /* Theme Factory - Home - middle */
      google_ad_slot = "5868515973";
      google_ad_width = 468;
      google_ad_height = 60;
      //-->
      </script>
      <script type="text/javascript"
      src="//pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
    </div>
  </div>
  <div class="span6">
    <div class="ad-content">
      <script type="text/javascript"><!--
      google_ad_client = "ca-pub-1319358860215477";
      /* Theme Factory - Home - middle */
      google_ad_slot = "5868515973";
      google_ad_width = 468;
      google_ad_height = 60;
      //-->
      </script>
      <script type="text/javascript"
      src="//pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
    </div>
  </div>
</div>

<p></p>

<div class="row">
  <?php for ( $i = 3; $i < 5 ; $i++ ) : ?>
    <div class="span6 small-theme">
      <a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[$i]->id, 'title' => Controller::makeMePretty( $random_five[$i]->name ) ) ); ?>"><img src="/image.php?width=570&height=320&cropratio=570:320&image=/files/screenshots/<?php echo $random_five[$i]->preview1 ?>"></a>
      <div class="small-theme-caption">
        <h5><a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $random_five[$i]->id, 'title' => Controller::makeMePretty( $random_five[$i]->name ) ) ); ?>"><?php echo $random_five[$i]->name; ?></a><span class="by-whom"> by <a href="<?php echo Yii::app()->controller->createUrl( '/theme/index', array( 'artist' => $random_five[$i]->user->username ) ); ?>"><?php echo $random_five[$i]->user->username; ?></a></span></h5>
      </div>
     </div>
   <?php endfor; ?>
</div>
