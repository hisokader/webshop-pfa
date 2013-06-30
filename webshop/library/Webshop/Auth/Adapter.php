<?php
class Webshop_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
	protected $_username;
	protected $_password;
	protected $_em;
	protected $_connectedAs;
	public function __construct($username,$password,$connectedAs)
	{
		$this->_username=$username;
		$this->_password=$password;
		$registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
        $this->_connectedAs=$connectedAs;
	}
	public function authenticate()
	{
		$listLogin = Webshop_Dao_ServiceDao::findMultiArgument($this->_em, "Compte", array('login = \'' . $this->_username. '\''));
        if(sizeof($listLogin)<=0) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,$this->_username,array("login failed"));
		}
		$compte=$listLogin[0];
		if(!Webshop_Utilities_PasswordHashe::isPasswordsMatch($this->_password,$compte->password , 5)) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,$this->_username,array("login failed"));
		}
		if(strcmp($compte->role,$this->_connectedAs)!=0) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS,$this->_username,array("not admin"));
		}
		if($compte->isActivated==0) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS,$this->_username,array("not activeted"));
		}
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS,$compte);
	}
}