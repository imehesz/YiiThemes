<?php
$this->breadcrumbs=array(
	'Themes',
);

$this->menu=array(
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<script>
    var confirmDelete = function()
    {
        //       
        conf = confirm( 'Are you sure?' );
        
        if( conf )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

</script>
<h1>Themes</h1>

<table border="1">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>
