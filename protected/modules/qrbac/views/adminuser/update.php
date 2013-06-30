<?php
$this->breadcrumbs=array(
	'管理员管理'=>array('admin'),
	'编辑管理员' . $model->username,
);

//$this->menu=array(
//	array('label'=>'管理员列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
//);
?>
<?php echo $this->renderPartial('_form',array('model'=>$model, 'allRole'=>$allRole)); ?>