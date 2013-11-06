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


            if(Application_Model_Service_ServiceDao::login($this->_em, $this->getRequest())){
                echo "login succes";
            }else
            echo "login failed";
            //sleep(3);
        } else
            echo "ajax request non";
    }

    public function signinAction()
    {
        //echo $this->getRequest()->getPost("login");
        $reponse = Application_Model_Service_ServiceDao::ajoutObjet($this->_em, "Compte", $this->getRequest());
        //$this->indexAction();
        var_dump($reponse);
    }

    public function logoutAction()
    {
        
        if (Zend_Session::sessionExists()) {
            //Zend_Session::namespaceUnset('MySession');
            Zend_Session::destroy(true,true);
            //Zend_Session::regenerateId();
            //Zend_Session::forgetMe();
       }
       $this->_redirect("index");
    }


}









