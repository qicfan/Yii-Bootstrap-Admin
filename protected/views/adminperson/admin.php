<?php
$this->breadcrumbs=array(
	'人物'=>array('admin'),
	'人物列表',
);

$this->menu=array(
	array('label'=>'添加人物','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'enableSorting'=>false,
	'filterPosition'=>false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		array(
			'type'=>'raw',
			'value'=>'"<img src=\'".$data->image_url."\' />"',
			'header'=>'头像',
		),
		'create_time',
		'hits',
		'last_hit',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
