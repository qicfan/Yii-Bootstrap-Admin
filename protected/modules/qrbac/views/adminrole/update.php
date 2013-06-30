<?php
$this->breadcrumbs=array(
	'角色列表'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'更新角色',
);

//$this->menu=array(
//	array('label'=>'角色列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
//);
?>

<h1>更新角色 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'tree'=>$tree)); ?>