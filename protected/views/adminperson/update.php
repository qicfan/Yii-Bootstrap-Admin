<?php
$this->breadcrumbs=array(
	'人物'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'编辑',
);
?>

<h1>编辑人物 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>