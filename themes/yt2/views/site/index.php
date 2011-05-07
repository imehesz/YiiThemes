			<?php 
				// TODO revise this and move to the controller ... what was I thinking???
				$themes = Theme::model()->findAllByAttributes( array('deleted'=>0  ), array( 'order'=> 'rand()', 'limit'=>5 ) ); 
				$image_magic_path = str_replace( 'index.php', 'image.php', $_SERVER['PHP_SELF'] );
			?>
            <div id="block-views-front-block_1" class="block block-views">
                <div class="content">
                    <div class="view view-front view-id-front view-display-id-block_1 view-dom-id-1"> 
                        <div class="view-content">
                            <div class="views-row views-row-1 views-row-odd views-row-first views-row-last">
                                <div id="node" class="node node-video">
                                    <div id="video">
										<?php $image = '/files/screenshots/' . $themes[0]->preview1; ?>
										<?php echo CHtml::link( CHtml::image( $image_magic_path . '?width=640&height=360&cropratio=640:360&image=' . $image, null, array( 'width' => '640', 'height' => '360', 'title' => $themes[0]->name ) ), Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $themes[0]->id ) ) ); ?>
                                    </div>
                                    <h2 class="teaser-title">
										<a href="<?php echo Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $themes[0]->id ) ); ?>">
											<?php echo $themes[0]->name ?> 
												<span class="client"><i>by</i> <?php echo $themes[0]->user->username ?></span>
										</a>
									</h2>
									<div class="social-links clear-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /block-views-front-block_1 -->

            <div id="block-views-front-block_2" class="block block-views">
                <div class="content">
                    <div class="view view-front view-id-front view-display-id-block_2 view-dom-id-2">
                        <div class="view-content">
                            <table class="views-view-grid">
                                <tbody>
									<?php $curr_theme = 1; for( $i=0; $i < 2 ; $i++ ) : ?>
                                    	<tr class="row-<?php echo $i ?> row">
											<?php for( $j=0 ; $j<2 ; $j++ ) : ?>
												<td class="col-1">
													<div id="node" class="node node-video">
														<?php $image = '/files/screenshots/' . $themes[$curr_theme]->preview1; ?>
														<?php echo CHtml::link( CHtml::image( $image_magic_path . '?width=310&height=174&cropratio=310:174&image=' . $image, null, array( 'width' => '310', 'height' => '174' ) ), Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $themes[$curr_theme]->id ) ) ); ?>
														<h3 class="teaser-title">
															<?php echo CHtml::link( $themes[$curr_theme]->name, Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $themes[$curr_theme]->id ) ) ); ?>
														</h3>
														<div class="client">
															<?php echo CHtml::link( '<i>by</i> ' . $themes[$curr_theme]->user->username, Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $themes[$curr_theme]->id ) ) ); ?>
														</div>
													</div>
												</td>
											<?php $curr_theme++; endfor; ?>
										</tr>
									<?php endfor; ?>
                                </tbody>
                            </table>
                        </div> <!-- /view-content -->
                    </div> <!-- /view view-front ... -->
                </div> <!-- /content -->
            </div> <!-- /block-view-front-block_2 -->

