<?php
class Zend_view_helpers_BaseUrl{
	function BaseUrl(){
		$frontController=Zend_Controller_Front::getInstance();
		return $frontController->getBaseUrl();

	}

}