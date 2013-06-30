<?php
$this->breadcrumbs=array(
	'Awards'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Awards','url'=>array('index')),
	array('label'=>'Create Awards','url'=>array('create')),
	array('label'=>'Update Awards','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Awards','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Awards','url'=>array('admin')),
);
?>

<h1>查看奖品批次 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cardbatch',
		'count',
		array(
			'type'=>'raw',
			'value'=>PersonAwards::$awardTypeNameMap[$model->type],
			'label'=>'奖品类型',
		),
	),
)); ?>
