<h1>My Themes</h1>

<div class="span12">
  <?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'theme-grid',
    'cssFile' => false,
    'enableSorting' => false,
    'itemsCssClass' => 'table table-bordered table-striped table-hover',
    'dataProvider' => $themes,
    'ajaxUpdate' => false,
    'pagerCssClass' => 'pagination',
    'pager' => array(
      'class' => 'CLinkPager',
      'cssFile' => false,
      'internalPageCssClass' => '',
      'selectedPageCssClass' => 'active',
      'header'  => ''
    ),
    'columns'=>array(
      array(
        'name' => 'name',
        //'value' => '"<a href="Yii::app()->createUrl(\"/theme/update\", array( \"id\" => $data->id ) )\">".$data->name."</a>"'
        'value' => '"<a href=\"". Yii::app()->createUrl("/theme/update", array("id"=>$data->id)) ."\">".$data->name."</a>"',
        'type' => 'raw'
      ),
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
        'viewButtonUrl' => 'Yii::app()->createUrl("/theme/view/", array( "id" => $data->id, "title" => Yii::app()->controller->makeMePretty($data->name)))',
        'deleteButtonUrl' => 'Yii::app()->createUrl("/theme/getdelete", array("id" => $data->id))'
      ),
    ),
  )); ?>
</div>
