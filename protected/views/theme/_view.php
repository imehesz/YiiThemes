<style>
    tr:hover
    {
        background-color: #eee;
    }
</style>

<?php
    $prev_image_mini = Yii::app()->request->baseUrl.'/files/screenshots/' . $data->preview1;
   
    if( ! $data->preview1 )
    {
        $prev_image_mini = Yii::app()->request->baseUrl.'/images/nocamera_mini.png';
    }
?>
<div>
    <tr id="theme_row_<?php echo $data->id; ?>">
            <td><img src="<?php echo $prev_image_mini; ?>" width="100px" height="75px"></td>
            <td><?php echo CHtml::link( $data->name, $this->createUrl( 'theme/view', array( 'id' => $data->id ) ) ); ?><br /><?php echo $data->short_desc;?></td>   
            
            
                <td>
                    <?php if( Yii::app()->user->id == $data->userID ) : ?>
                        <a href="<?php echo $this->createUrl( 'theme/update', array( 'id' => $data->id ) ); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/update.png';?>" alt="update this theme" title="update this theme"></a>
                        <a href="javascript:void(0);" onClick='javascript:if(deleteTheme("<?php echo $this->createUrl( 'ajaxDelete', array( 'id' => $data->id ) ); ?>")){$("#theme_row_<?php echo $data->id ?>").hide();};'>
                            <img src="<?php echo Yii::app()->request->baseUrl . '/images/delete.png';?>" alt="delete this theme" title="delete this theme">
                        </a>
                    <?php endif; ?>
                </td>   
    </tr>
</div>

<?php /*
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userID')); ?>:</b>
	<?php echo CHtml::encode($data->userID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preview1')); ?>:</b>
	<?php echo CHtml::encode($data->preview1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preview2')); ?>:</b>
	<?php echo CHtml::encode($data->preview2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

</div>
*/ 
?>
