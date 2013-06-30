<?php
$this->breadcrumbs=array(
	'Admin Actions'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'动作列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
	array('label'=>'更新动作','url'=>array('update','id'=>$model->id)),
	array('label'=>'删除动作','url'=>'#','linkOptions'=>array('class'=>'btn btn-danger', 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看动作 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'action',
		'parent_id',
	),
)); ?>
