<div id="content">
    <h1>Layouts</h1>

	<p>
		Just simply place the downloaded layout under the application's <tt style="color:#000;">themes/</tt> folder, and update the <tt style="color:#000;">components/Controller.php</tt> file to load the correct layout and you should be good to go.
	</p>

    <div class="layout-box">
        Sidebar Left
        <?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/main-right.jpg'), Yii::app()->request->baseUrl . '/downloads/lefty.zip', array( 'title' => 'download lefty' ) ); ?>
    </div>

    <div class="layout-box">
        Sidebar Right
        <?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/main-left.jpg' ), Yii::app()->request->baseUrl . '/downloads/righty.zip', array( 'title' => 'download righty' ) ); ?>
    </div>

    <div class="layout-box">
        Double Dynamite
        <?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/mirror.jpg' ), Yii::app()->request->baseUrl . '/downloads/double.zip', array( 'title' => 'download double' ) ); ?>
    </div>

    <div class="layout-box">
        Triplets
        <?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/threecol.jpg' ), Yii::app()->request->baseUrl . '/downloads/triplets.zip' ); ?>
    </div>

    <div style="clear:both;"></div>
</div>
