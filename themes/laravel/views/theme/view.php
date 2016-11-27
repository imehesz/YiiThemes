<header class="jumbotron subhead" id="overview">
  <div class="row">
    <div class="span12">
      <h1>
        <?php echo $model->name; ?>
        <div class="pull-right">
          <!-- AddThis Button BEGIN -->
          <a class="addthis_button" href="//www.addthis.com/bookmark.php?v=300&amp;pubid=ra-4dc48dcc77246178"><img src="//s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dc48dcc77246178"></script>
          <!-- AddThis Button END -->
        </div>
      </h1>
    </div>
  </div> <!-- .row -->
</header>

<div class="row">
  <div class="span12 main-theme">
    <img src="/image.php?width=1170&height=658&cropratio=1170:658&image=/files/screenshots/<?php echo $model->preview1; ?>">
  </div> <!-- .span12 -->
</div> <!-- .row -->

<div class="row">
  <div class="span12 ad-content">
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-1319358860215477";
    /* Theme Factory - Theme View - Big */
    google_ad_slot = "4252181977";
    google_ad_width = 728;
    google_ad_height = 90;
    //-->
    </script>
    <script type="text/javascript"
    src="//pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
  </div>
</div>

<div class="row">
  <div class="span6">
    <div class="well">
      <?php if ( ThemeUser::model()->canDownloadByIp( $model->id ) ) : ?>
        <p>
          <a class="btn btn-warning" href="/theme/download/?id=<?php echo $model->id; ?>">Download</a>
        </p>
      <?php endif; ?>
      <p> <div class="label">Author</div> <a href="<?php echo Yii::app()->controller->createUrl( '/theme/index', array( 'artist' => $model->user->username ) ); ?>"><?php echo $model->user->username; ?></a> </p>
      <p> <div class="label">Viewed</div> <?php echo number_format( $model->viewed); ?></p>
      <p> <div class="label">Downloaded</div> <?php echo number_format( $model->downloaded); ?></p>
      <p> <div class="label">Score</div> <?php echo number_format( $model->downloaded / $model->viewed * 100, 2 ); ?> </p>
      <p> <div class="label">Created</div> <?php echo date("l M j, Y", $model->created ); ?></p>
      <p> <div class="label">Updated</div> <?php echo date("l M j, Y", $model->updated ); ?></p>
      <p class="ad-content">
        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-1319358860215477";
        /* Theme Factory - Theme View - Middle */
        google_ad_slot = "5728915172";
        google_ad_width = 468;
        google_ad_height = 60;
        //-->
        </script>
        <script type="text/javascript"
        src="//pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
      </p>
      <p><?php echo $model->short_desc; ?></p>
      <p><?php $md = new CMarkdown; $md->cssFile = false; echo $md->transform( $model->long_desc ); ?></p>
    </div>
  </div>
  <div class="span6">
  <!-- AddThis Button BEGIN -->
  <div class="addthis_toolbox addthis_default_style ">
  <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
  <a class="addthis_button_tweet"></a>
  <a class="addthis_button_pinterest_pinit"></a>
  <a class="addthis_counter addthis_pill_style"></a>
  </div>
  <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dc48dcc77246178"></script>
  <!-- AddThis Button END -->

  <div class="ad-content">
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-1319358860215477";
    /* Theme Factory - Theme View - Middle 2 */
    google_ad_slot = "3142048772";
    google_ad_width = 468;
    google_ad_height = 60;
    //-->
    </script>
    <script type="text/javascript"
    src="//pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
  </div>

  <div id="disqus_thread"></div>
  <script type="text/javascript">
      /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
      var disqus_shortname = 'bootstrapthemefactory'; // required: replace example with your forum shortname

      /* * * DON'T EDIT BELOW THIS LINE * * */
      (function() {
          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
          dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="//disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
  <a href="//disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

  </div> <!-- .span16 -->
</div> <!-- .row -->
