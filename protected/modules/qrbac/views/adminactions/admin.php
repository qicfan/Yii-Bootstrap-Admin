<?php
$this->breadcrumbs=array(
	'动作管理'=>array('admin'),
	'动作列表',
);

$this->menu=array(
	array('label'=>'创建动作','url'=>array('create'), 'linkOptions'=>array('class'=>'btn btn-primary')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'admin-actions-grid',
	'type'=>'striped bordered condensed',
	'enableSorting'=>false,
	'filterPosition'=>false,
	'template' => '{items}{pager}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'parent_id',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
