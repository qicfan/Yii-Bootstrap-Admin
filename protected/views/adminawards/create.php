<?php
$this->breadcrumbs=array(
	'Awards'=>array('index'),
	'Create',
);
?>

<h1>添加批次</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>