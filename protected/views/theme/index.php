<?php
$this->breadcrumbs=array(
	'Themes',
);

$this->menu=array(
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>Themes</h1>

<table border="1">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>

<script>
    var deleteTheme = function( urlDel )
    {
        conf = confirm( 'Are you sure?' );

        if( conf )
        {
            $.ajax({
              url: urlDel,
              success: function(data) {
                // $('.result').html(data);
                if( data != 'fail' )
                {
                    alert('Theme deleted successfully!');
                    return true;
                }
                else
                {
                    alert( 'Oops... Please try again!' );
                }
              }
            });            
        }
        return false;
    }

</script>