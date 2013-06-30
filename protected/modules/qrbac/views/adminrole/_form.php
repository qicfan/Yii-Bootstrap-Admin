<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'admin-role-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?>
	
	<?php echo $form->labelEx($model,'actions'); ?>
	<?php echo $tree;?>
	<?php echo $form->error($model,'actions'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '更新',
		)); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'link',
			'label'=>'返回',
			'url'=>Yii::app()->createUrl('/qrbac/adminrole/admin'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>