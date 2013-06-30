<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'awards-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cardbatch',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'count',array('class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'type',PersonAwards::$awardTypeNameMap); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
