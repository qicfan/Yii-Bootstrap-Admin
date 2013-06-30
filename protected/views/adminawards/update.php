<?php
$this->breadcrumbs=array(
	'奖品批次管理'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'批次更新',
);

?>

<h1>更新批次 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>