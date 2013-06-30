<?php
$this->breadcrumbs=array(
	'管理员动作管理'=>array('admin'),
	'创建动作',
);

//$this->menu=array(
//	array('label'=>'动作列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
//);
?>

<h1>创建动作</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree)); ?>