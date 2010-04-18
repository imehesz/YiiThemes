<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'View Theme', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>Update Theme: <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>