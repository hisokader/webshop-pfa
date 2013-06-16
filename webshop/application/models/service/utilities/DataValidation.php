<?php
class Application_Model_Service_Utilities_DataValidation
{

    public static function signInCheck($compte)
    {
        $loginValid = new Zend_Validate();
        $loginValid->addValidator(new Zend_Validate_Alnum())
              ->addValidator(new Zend_Validate_StringLength(array('max' => 15,'min' => 6)));
        $EmailValid = new Zend_Validate_EmailAddress();
        $passwordValid= new Zend_Validate_StringLength(array('max' => 15,'min' => 6));
        $namesValid= new Zend_Validate();
        $namesValid->addValidator(new Zend_Validate_Alpha())
              ->addValidator(new Zend_Validate_StringLength(array('max' => 20,'min' => 2)));
        $listErreur = array();

        if (!$loginValid->isValid($compte->getPost('login'))) {
            array_push($listErreur, 'login');
        }
        if ($passwordValid->isValid($compte->getPost('password'))) {
            if(strcmp($compte->getPost('passwordConf'), $compte->getPost('password'))!=0){
                array_push($listErreur, 'passwordConf');
            }   
        }else{
          array_push($listErreur, 'password');
        }
        if (!$EmailValid->isValid($compte->getPost('email'))) {
            array_push($listErreur, 'email');
        }
        if (!$namesValid->isValid($compte->getPost('lastName'))) {
            array_push($listErreur, 'lastName');
        }
        if (!$namesValid->isValid($compte->getPost('firstName'))) {
            array_push($listErreur, 'firstName');
        }
        return $listErreur;
    }
}
