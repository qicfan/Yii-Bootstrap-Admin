<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'person-form',
	'enableAjaxValidation' => false,
		));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 20)); ?>

<?php echo $form->textFieldRow($model, 'description', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->labelEx($model, 'image_url'); ?>
<?php echo $form->hiddenField($model, 'image_url', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo CHtml::fileField('tmp_image_url', '', array('class' => '', 'id' => 'Person_tmp_image_url', 'value' => '选择PC端图片上传')); ?>
<?php echo CHtml::button('上传', array('class' => 'v_butn', 'id' => 'upload_img')) ?>
<?php echo $form->error($model, 'image_url'); ?>
<br />
<ul id="image_preview" class="thumbnails">
	<?php if (!$model->isNewRecord): ?>
		<li class="span2">
			<a href="javascript:;" class="thumbnail" rel="tooltip" data-title="Tooltip">
				<img src="<?php echo $model->image_url;?>" alt="">
			</a>
		</li>
	<?php endif; ?>
</ul>

<div class="form-actions">
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => $model->isNewRecord ? '保存' : '更新',
	));
	?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/static/js/ajaxfileupload.js"></script>
<script type="text/javascript">
	function AddImgUrl(url)
	{
		$('#image_preview').html("");
		var image = $('<li class="span2"><a href="javascript:;" class="thumbnail" rel="tooltip" data-title="Tooltip"><img src="'+url+'" alt=""></a></li>');
		$('#image_preview').append(image);
	}
	$("#upload_img").click(function(){
		var tmp_img_val = $("#Person_tmp_image_url").val();
		if(tmp_img_val == '' || tmp_img_val == 0 || tmp_img_val == undefined)
		{
			alert('请选择上传图片！');
			return false;
		}
		$.ajaxFileUpload
		(
		{
			url:'<?php echo Yii::app()->createUrl('/Adminperson/UploadImg'); ?>',
			secureuri:false,
			fileElementId:'Person_tmp_image_url',
			dataType: 'json',
			data:{filename:'tmp_image_url'},
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						alert(data.error);
					}else
					{
						var img_url = data.msg;
						if(typeof(data.msg) != 'undefined')
						{
							$('#Person_image_url').val(img_url);
							AddImgUrl('<?php echo Yii::app()->baseUrl; ?>'+img_url);
						}
						else
						{
							alert('图片上传失败');
						}
					}
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	);
	});
</script>