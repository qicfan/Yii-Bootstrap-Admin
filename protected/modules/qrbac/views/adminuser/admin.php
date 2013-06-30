<?php
$this->breadcrumbs=array(
	'管理员管理'=>array('admin'),
	'管理员列表',
);
$this->menu=array(
	array('label'=>'添加管理员','url'=>array('create'),'linkOptions'=>array('class'=>'btn btn-primary')),
);
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'type'=>'striped bordered condensed',
	'id'=>'admin-user-grid',
	'dataProvider'=>$model->search(),
	'enableSorting'=>false,
	'filterPosition'=>false,
	'filter'=>$model,
	'template' => '{items}{pager}',
	'columns'=>array(
		'id',
		'username',
		'last_ip',
		array(
			'type'=>'raw',
			'filter'=>false,
			'header'=>'创建时间',
			'id'=>'create_time',
			'name'=>'create_time',
			'value'=>'date("Y-m-d H:i:s",$data->create_time)',
			'htmlOptions'=>array('align'=>'center'),
		),
		array(
			'type'=>'raw',
			'filter'=>false,
			'header'=>'更新时间',
			'id'=>'update_time',
			'name'=>'update_time',
			'value'=>'date("Y-m-d H:i:s",$data->update_time)',
			'htmlOptions'=>array('align'=>'center'),
		),array(
			'type'=>'raw',
			'filter'=>false,
			'header'=>'最后登陆时间',
			'id'=>'last_time',
			'name'=>'last_time',
			'value'=>'date("Y-m-d H:i:s",$data->last_time)',
			'htmlOptions'=>array('align'=>'center'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array(
				'delete'=>array('visible'=>'$data->id>1'),
			),
		),
	),
)); ?>
