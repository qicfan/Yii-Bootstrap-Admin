<?php
$this->breadcrumbs=array(
	'角色列表'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'角色列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
	array('label'=>'更新角色','url'=>array('update','id'=>$model->id)),
	array('label'=>'删除角色','url'=>'#','linkOptions'=>array('class'=>'btn btn-danger', 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看角色 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		array(
			'type'=>'raw',
			'value'=>$model->actions,
			'label'=>'动作列表',
		),
	),
)); ?>
