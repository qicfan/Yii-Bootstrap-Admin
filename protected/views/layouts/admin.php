<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $this->pageTitle; ?></title>
		<style>
			.bottom_menu{position: fixed; bottom:0; text-align: center; z-index: 1;}
			.bottom_menu a { margin-right: 20px;}
		</style>
	</head>
	<body data-spy="scroll" data-target=".navbar" id="top">
		<?php
		$this->widget('bootstrap.widgets.TbNavbar', array(
			'type' => 'null', // null or 'inverse'
			'brand' => Yii::app()->name . "管理后台",
			'brandUrl' => Yii::app()->createUrl('/site/index'),
			'collapse' => true, // requires bootstrap-responsive.css
			'items' => array(
				array(
					'class' => 'bootstrap.widgets.TbMenu',
					'htmlOptions' => array('class' => 'pull-right'),
					'items' => array(
						array('visible' => !Yii::app()->user->isGuest, 'label' => Yii::app()->user->name, 'url' => '#'),
						array('visible' => !Yii::app()->user->isGuest, 'label' => '[退出登陆]', 'url' => Yii::app()->createUrl('/qrbac/site/logout')),
						array('visible' => Yii::app()->user->isGuest, 'label' => '[登陆]', 'url' => Yii::app()->createUrl('/qrbac/site/login')),
					),
				),
			),
		));
		?>
		<div class="container" style="margin-top:41px; margin-bottom:41px;">
			<div class="row">
				<div class="span2">
					<div class="sidebar-nav">
						<?php
						$this->widget('bootstrap.widgets.TbMenu', array(
							'type' => 'list', // '', 'tabs', 'pills' (or 'list')
							'stacked' => true, // whether this is a stacked menu
							'dropup' => false,
							'items' => array(
								array('label' => '首页', 'icon'=>'home', 'url' => array('/site/index')),
								array('label' => '缓存管理'),
								array('label' => '清除缓存','icon'=>'remove', 'url' => array('/admincache/admin')),
								array('label' => 'ElasticSearch'),
								array('label' => 'ES查询', 'icon'=>'search', 'url' => array('/admines/admin')),
								array('label' => '报表管理'),
								array('label' => '订单失败报表', 'icon'=>'remove', 'url' => array('#')),
								array('label' => '订单成功报表', 'icon'=>'ok', 'url' => array('#')),
								array('label' => '权限管理'),
								array('visible' => $this->checkAccess('adminuser.manage', true), 'icon' => 'user', 'label' => '管理员管理', 'url' => array('/qrbac/adminuser/admin')),
								array('visible' => $this->checkAccess('adminrole.manage', true), 'icon'=>'th-list', 'label' => '角色管理', 'url' => array('/qrbac/adminrole/admin')),
								array('visible' => $this->checkAccess('adminactions.manage', true), 'icon'=>'th-list', 'label' => '动作管理', 'url' => array('/qrbac/adminactions/admin')),
								array('visible' => $this->checkAccess('adminlogs.manage', true), 'label' => '操作日志', 'icon' => 'list', 'url' => array('/qrbac/adminlogs/admin')),
							),
						));
						?>
					</div>
				</div>
				<div class="span10">
					<?php
					if ($this->breadcrumbs)
					{
						$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
							'homeLink' => CHtml::link(Yii::t('zii', 'Home'), Yii::app()->createUrl('site/index')),
							'links' => $this->breadcrumbs,
						));
					}
					?>
					<?php echo $content; ?>

				</div>
			</div>
		</div>
		<?php
		if (!empty($this->menu)):
			?>
			<div class="bottom_menu breadcrumb" style="width:100%; margin:0px;">
				<?php
				$this->widget('BottomMenu', array('items' => $this->menu));
				?>
			</div>
			<?php
		endif;
		?>
	</body>
</html>