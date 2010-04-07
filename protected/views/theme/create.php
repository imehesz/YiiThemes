<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>Create Theme</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>