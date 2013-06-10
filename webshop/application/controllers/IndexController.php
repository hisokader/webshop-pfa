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

            Application_Model_Service_ServiceDao::login($this->_em, $this->getRequest());

            if (Zend_Session::namespaceIsset('MySession')) {
                $session = new Zend_Session_Namespace('MySession');
                $userName = $session->compte;
                echo unserialize($userName)->email . '  -';
            }

            sleep(3);
        } else
            echo "ajax request non";
    }

    public function signinAction()
    {
        $reponse = Application_Model_Service_ServiceDao::ajoutObjet($this->_em, "Compte", $this->getRequest());
        //var_dump($reponse);
    }


}







