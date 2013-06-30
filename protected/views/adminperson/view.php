<?php
$this->breadcrumbs=array(
	'人物'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'返回列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
	array('label'=>'添加','url'=>array('create')),
	array('label'=>'更新','url'=>array('update','id'=>$model->id)),
	array('label'=>'删除','url'=>'#','linkOptions'=>array('class'=>'btn btn-danger', 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Person #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		array(
			'type'=>'raw',
			'value'=>"<img src='".$model->image_url."' />",
			'label'=>'头像',
		),
		'create_time',
		'hits',
		'last_hit',
		'description',
	),
)); ?>
<h3>投票列表</h3>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-hit-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$hitsProvider,
	'enableSorting'=>false,
	'filterPosition'=>false,
	'filter'=>$personHit,
	'columns'=>array(
		'hit_time',
		'ip',
		'uuid',
	),
)); ?>
