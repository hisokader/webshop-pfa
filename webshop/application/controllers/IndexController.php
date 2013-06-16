<?php
//require_once APPLICATION_PATH . '\library\PasswordHash\PasswordHashe.php';


class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            //Zend_Session::rememberMe(seconde);
            //Zend_Session::forgetMe();demande au navigateur de detruire la session apres l'arret du navigateur
            //sessionExists()
            $auth = Zend_Auth::getInstance();
            $result= $auth->authenticate(new Webshop_Auth_Adapter($this->getRequest()->getParam('login'),$this->getRequest()->getParam('password'),'user'));
            if($result->isValid()){
                echo "login succes";
            }else{
                $msgs=$result->getMessages();
                echo $msgs[0];
            }
                
        } 
    }

    public function signinAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            //sleep(4);
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            //echo $this->getRequest()->getPost("login");
            $reponse = Application_Model_Service_ServiceDao::ajoutObjet($this->_em, "Compte", $this->getRequest());
            //$this->indexAction();
            echo json_encode(array("error"=>$reponse));
        }
    }

}









