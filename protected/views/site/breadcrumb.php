<?php
if ($this->breadcrumbs)
{
	$this->widget('BreadCrumb', array(
		'links' => $this->breadcrumbs,
	));
}
?>