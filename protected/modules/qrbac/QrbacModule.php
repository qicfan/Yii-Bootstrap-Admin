<?php
/**
 * Description of QrbacModule
 *
 * @author qicfan
 */
class QrbacModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(  
            'qrbac.models.*',  
            'qrbac.components.*',  
        ));  
	}
}

?>
