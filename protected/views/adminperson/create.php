<?php
$this->breadcrumbs=array(
	'人物'=>array('admin'),
	'创建',
);
?>

<h1>创建人物</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>