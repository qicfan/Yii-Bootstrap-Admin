<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$personDataProvider,
    'template'=>"{items}",
    'itemView'=>'/front/_thumb',
)); ?>

<script type="text/javascript">
// 绑定图片的点击事件
// 1、触发JS投票
// 2、播放卡牌翻动效果
// 3、展示人物头像
$('.person_thumb').live('click', function(){
	var obj = $(this);
	var id = obj.attr('data-id');
	jQuery.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createUrl('index/AjaxHit');?>',
		dataType: 'json',
		data: {
			'id': id
		},
		success: function(data){
			obj.attr('src', obj.attr('data-original'));
			if (data.code == '10003' || data.code == '10005')
			{
				window.location = '<?php echo Yii::app()->createUrl('index/award');?>';
			}
			if (data.code == '10000')
			{
				return ;
			}
			else
			{
				alert(data.msg);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.responseText);
		}
	});

});
</script>