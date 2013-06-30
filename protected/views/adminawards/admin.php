<?php
$this->breadcrumbs=array(
	'奖品批次管理'=>array('admin'),
	'批次列表',
);

$this->menu=array(
	array('label'=>'添加奖品批次','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'awards-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting'=>false,
	'filterPosition'=>false,
	'columns'=>array(
		'id',
		'cardbatch',
		'count',
		array(
			'type'=>'raw',
			'value'=>'PersonAwards::$awardTypeNameMap[$data->type]',
			'header'=>'奖品类型',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
