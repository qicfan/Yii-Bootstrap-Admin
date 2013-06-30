<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array('class' => 'form-horizontal'),
		));
?>
<fieldset>
	<legend>登录</legend>
	<div class="control-group">
		<label for="input01" class="control-label">用户名：</label>
		<div class="controls">
			<?php echo $form->textField($model, 'username', array('class' => 'input-xlarge')); ?>
		</div>
	</div>

	<div class="control-group">
		<label for="input01" class="control-label">密码：</label>
		<div class="controls">
			<?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge')); ?>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit">登录</button>
	</div>
</fieldset>
<?php $this->endWidget(); ?>