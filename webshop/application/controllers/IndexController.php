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
         if($this->getRequest()->isXmlHttpRequest()){
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            //$autoloader = Zend_Loader_Autoloader::getInstance();
            //$loader = new Zend_Loader_PluginLoader();
            //$loader->addPrefixPath('Application_services_utilities', 'application/modules/services/utilities');
            echo "1 = ".$this->getRequest()->getParam('login').", 2 : ".Application_Model_Utilities_PasswordHashe::passwordHashing("kader",5);
            $localpass=Application_Model_Utilities_PasswordHashe::passwordHashing("kader",5);
            if(Application_Model_Utilities_PasswordHashe::isPasswordsMatch($this->getRequest()->getParam('login'),$localpass,5))
                echo "true";
            else
                echo "false";
            sleep(3);
         }else
            echo "ajax request non";
    }

    public function signinAction()
    {
        $login=$this->getRequest()->getPost('login');
        $password=$this->getRequest()->getPost('password');
        $passwordConfirm=$this->getRequest()->getPost('passwordConf');
        $lastName=$this->getRequest()->getPost('lastName');
        $firstName=$this->getRequest()->getPost('firstName');
        $email=$this->getRequest()->getPost('email');

        //si toutes les informations sont correctes alors en ajoute le nouveau utilisateur        
        
        //$userPassword="../application/services/utilities"sha1("#$&I>,.:|'oU");
        //$passwordSaltedAndCrypted=$salt.sha1($password)."I>,.:|'oU";

    }


}







