<?php
$this->breadcrumbs=array(
	'角色列表'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'添加角色','url'=>array('create'),'linkOptions'=>array('class'=>'btn btn-primary')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'admin-role-grid',
	'type'=>'striped bordered condensed',
	'enableSorting'=>false,
	'filterPosition'=>false,
	'template' => '{items}{pager}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
//			'template'=>'{view}',
			'buttons'=>array(
				'update'=>array('visible'=>'$data->id>1 && $data->title!=\'超级管理员\' && $data->actions!=\'*\''),
				'delete'=>array('visible'=>'$data->id>1 && $data->title!=\'超级管理员\' && $data->actions!=\'*\''),
			),
		),
	),
)); ?>
