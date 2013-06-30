<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'admin-actions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>20)); ?>
	
	<?php echo $form->textFieldRow($model,'action',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->labelEx($model,'parent_id'); ?>
	<select name="AdminActions[parent_id]" id="AdminActions_parent_id">
	<?php echo $tree;?>
	</select>
	<?php echo $form->error($model,'parent_id'); ?>

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
			'url'=>Yii::app()->createUrl('/qrbac/adminactions/admin'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
