<?php
$this->breadcrumbs=array(
	'Admin Actions'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'动作列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
//);
?>

<h1>更新动作 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'tree'=>$tree)); ?>