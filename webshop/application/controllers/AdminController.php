<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function adminloginAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            //Zend_Session::rememberMe(seconde);
            //Zend_Session::forgetMe();demande au navigateur de detruire la session apres l'arret du navigateur
            //sessionExists()
            $auth = Zend_Auth::getInstance();
            $result= $auth->authenticate(new Webshop_Auth_Adapter($this->getRequest()->getParam('login'),$this->getRequest()->getParam('password'),'admin'));
            if($result->isValid()){
                echo "login succes";
            }else{
                $msgs=$result->getMessages();
                echo $msgs[0];
            }
        }
    }


}



