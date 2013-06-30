<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
    }

    public function indexAction()
    {
      $auth = Zend_Auth::getInstance();
      if ($auth->hasIdentity()){
        $listLogin = Webshop_Dao_ServiceDao::findMultiArgument($this->_em, "Compte", array('login = \'' . $auth->getIdentity()->login. '\''));
        $this->view->identity=$listLogin[0];
      }
        
        
    }

    public function logoutAction()
    {
       if (Zend_Session::sessionExists()) { 
         Zend_Auth::getInstance()->clearIdentity(); 
         Zend_Session::destroy(true,true); 
       }
       $this->_helper->redirector('index','index');
    }

    public function updateuserAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $reponse=Webshop_Utilities_DataValidation::compteCheck($this->getRequest());
            if(sizeof($reponse)<=4){
              try{
                Webshop_Dao_ServiceDao::updateCompte($this->_em,$this->getRequest());
                echo "success";
              }catch(Exception $e){ echo $e;}
              
            }else{
              echo json_encode(array("error"=>$reponse));
            }

          }
    }


}





