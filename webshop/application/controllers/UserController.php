<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body 
    }

    public function logoutAction()
    {
       if (Zend_Session::sessionExists()) { 
       Zend_Auth::getInstance()->clearIdentity(); 
       Zend_Session::destroy(true,true); 
       }
       $this->_helper->redirector('index','index');
    }


}



