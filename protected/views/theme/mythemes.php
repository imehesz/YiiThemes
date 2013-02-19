<h1>My Themes</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'theme-grid',
  'cssFile' => false,
  'enableSorting' => false,
  'itemsCssClass' => 'table table-bordered table-striped table-hover',
	'dataProvider' => $themes,
	'columns'=>array(
		'name',
		'short_desc',
    array(
      'name' => 'created',
      'value' => 'date("M j, Y H:i", $data->created)'
    ),
    array(
      'name' => 'updated',
      'value' => 'date("M j, Y H:i", $data->updated)'
    ),
    array(
      'name'  => 'viewed',
      'value' => 'number_format($data->viewed)'
    ),
    array(
      'name'  => 'downloaded',
      'value' => 'number_format($data->downloaded)'
    ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
