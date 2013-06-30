<?php
$this->breadcrumbs=array(
	'获奖者列表'=>array('admin'),
	'Manage',
);
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'enableSorting'=>false,
	'filterPosition'=>false,
	'filter'=>$model,
	'id'=>'person-awards-grid',
	'columns'=>array(
		'id',
		'uuid',
		array(
			'type'=>'raw',
			'value'=>'date("Y-m-d H:i:s", $data->create_time)',
			'header'=>'获奖时间',
		),
		array(
			'type'=>'raw',
			'value'=>'($data->receive_time ? date("Y-m-d H:i:s", $data->receive_time) : "")',
			'header'=>'领奖时间',
		),
		array(
			'type'=>'raw',
			'value'=>'$data->getStateName()',
			'header'=>'领奖状态',
		),
		'wm_username',
		'mobile',
		array(
			'type'=>'raw',
			'value'=>'$data->getAwardTypeName()',
			'header'=>'奖品类型',
		),
		array(
			'type'=>'raw',
			'value'=>'$data->getWmStatusName()',
			'header'=>'我买网领奖状态',
		),
		'cardbatch',
	),
)); ?>
