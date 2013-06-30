<?php
$this->breadcrumbs=array(
	'管理员管理'=>array('admin'),
	'查看管理员' . $model->username,
);

$this->menu=array(
	array('label'=>'管理员列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
	array('label'=>'更新管理员','url'=>array('update','id'=>$model->id)),
	array('label'=>'删除管理员','url'=>'#','linkOptions'=>array('class'=>'btn btn-danger', 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'last_ip',
		array(
			'value'=>date('Y-m-d H:i:s', $model->create_time),
			'label'=>'创建时间'
		),
		array(
			'value'=>date('Y-m-d H:i:s', $model->update_time),
			'label'=>'更新时间'
		),
		array(
			'value'=>empty($model->last_time) ? null : date('Y-m-d H:i:s', $model->last_time),
			'label'=>'最后登录时间'
		),
		array(
			'value'=>$model->role->title,
			'label'=>'角色'
		),
	),
)); ?>
