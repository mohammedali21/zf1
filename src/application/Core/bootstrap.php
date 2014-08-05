<?php 

class Core_Bootstrap extends Zend_Application_Module_Bootstrap{
	
	protected function _initMynav(){
		$loader = new Zend_Application_Module_Autoloader(
			array(
				'namespace' => 'Core_Navigation',
				'basePath' => APP_PATH . '/Core/navigation'	
			)
		);
	}
	
	
} //ljqgjqgh