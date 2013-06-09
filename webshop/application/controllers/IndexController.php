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

    public function authentificationAction()
    {
    }

    public function loginAction()
    {
        // action body
    }


}





