<?php

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
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $reponse = Application_Model_Service_ServiceDao::ajoutObjet($this->_em, "Compte", $this->getRequest());
            if(sizeof($reponse)<=0){
                $activationlink="http://localhost/webshop/public/index/activatingAccount?activationCode=";
                $activationlink.=Application_Model_Service_ServiceDao::getAccountActivationCode($this->_em,$this->getRequest()->getPost('email'));
                $activationlink.="&email=".$this->getRequest()->getPost('email');
                $mailRecovry=Webshop_Email_Email::getInstance();
                $mailRecovry->sendConfirmationMail($this->getRequest()->getPost('email'),$activationlink);
            }
            echo json_encode(array("error"=>$reponse));
        }
    }

    public function adminloginAction()
    {
         if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
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

    public function passwordrecovryAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $email=$this->getRequest()->getParam('emailRecover');
            $EmailValid = new Zend_Validate_EmailAddress();
            if($EmailValid->isValid($email)){

                $newPassword=Webshop_Utilities_PasswordHashe::randomString(5);
                try{
                    if(Application_Model_Service_ServiceDao::passwordUpdate($this->_em,$email,$newPassword)==1){
                        $mailRecovry=Webshop_Email_Email::getInstance();
                        $mailRecovry->sendPasswordRecovryMail($email,$newPassword);
                        echo 'success recovry';
                    }else
                        echo 'error';
                }catch(Exception $e){
                    var_dump($e);
                }
               
            }else
                echo 'error';
        }
    }

    public function activatingaccountAction()
    {
        $email=$this->getRequest()->getParam('email');
        $activationCode=$this->getRequest()->getParam('activationCode');
        $realActivationCode=Application_Model_Service_ServiceDao::getAccountActivationCode($this->_em,$this->getRequest()->getParam('email'));
        if(strcmp($realActivationCode, $activationCode)==0){
            Application_Model_Service_ServiceDao::activatingAccount($this->_em,$this->getRequest()->getParam('email'));
            $this->view->msgTitle = "Your Account is now well activated!";
            $this->view->msg = "you can now login without a probleme .";
        }else{
            $this->view->msgTitle = "Wrong activation code! ";
            $this->view->msg = "the activation code you try to use, is wrong, check your email for a right one, or contact adminstration.";
        }


    }


}
