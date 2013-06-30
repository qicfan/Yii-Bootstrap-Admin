<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'admin-user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>12, 'autocomplete'=>"off", 'placeholder'=>'4-12字符')); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>32, 'autocomplete'=>"off", 'placeholder'=>'任意字符')); ?>
	
	<?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>32, 'placeholder'=>'RePassword')); ?>
	
	 <?php echo $form->dropDownListRow($model, 'role_id', $allRole); ?>
	
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
			'url'=>Yii::app()->createUrl('/qrbac/adminuser/admin'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
