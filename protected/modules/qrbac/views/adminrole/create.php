<?php
$this->breadcrumbs=array(
	'角色列表'=>array('admin'),
	'添加角色',
);

//$this->menu=array(
//	array('label'=>'角色列表','url'=>array('admin'), 'linkOptions'=>array('class'=>'btn btn-primary')),
//);
?>

<h1>创建角色</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree)); ?>