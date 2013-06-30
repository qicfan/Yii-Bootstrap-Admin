<div class="span2">
	<div class="sidebar-nav">
		<?php
		$this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
			'stacked' => false, // whether this is a stacked menu
			'items' => array(
				array('visible' => $this->checkAccess('person', true), 'label' => '人物管理', 'url' => array('/adminperson/admin')),
				array('visible' => $this->checkAccess('personawards', true), 'label' => '获奖记录', 'url' => array('/adminpersonawards/admin')),
				array('visible' => $this->checkAccess('awards', true), 'label' => '奖品批次管理', 'url' => array('/adminawards/admin')),
				array('label' => '管理员管理',
					'items' => array(
						array('visible' => $this->checkAccess('adminuser.manage', true), 'label' => '管理员列表', 'url' => array('/qrbac/adminuser/admin')),
						array('visible' => $this->checkAccess('adminrole.mange', true), 'label' => '角色列表', 'url' => array('/qrbac/adminrole/admin')),
						array('visible' => $this->checkAccess('adminactions.mange', true), 'label' => '动作列表', 'url' => array('/qrbac/adminactions/admin')),
//								array('label'	 => '操作日志列表', 'url'	 => array('/qrbac/adminlogs/admin')),
				)),
			),
		));
		?>
	</div>
</div>