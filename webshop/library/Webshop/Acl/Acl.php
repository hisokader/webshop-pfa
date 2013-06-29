<?php
class Webshop_Acl_Acl extends Zend_Acl {
  public function __construct() {
    //Add a new role called "guest"
    $this->addRole(new Zend_Acl_Role('guest'));
 
    //Add a role called user, which inherits from guest
    $this->addRole(new Zend_Acl_Role('user'), 'guest');

    //Add a role called user, which inherits from guest
    $this->addRole(new Zend_Acl_Role('admin'),'user');
 
    //Add a resource called page
    $this->add(new Zend_Acl_Resource('index'));
 
    //Add a resource called news, which inherits page
    $this->add(new Zend_Acl_Resource('user'));
    $this->add(new Zend_Acl_Resource('admin'));
    $this->add(new Zend_Acl_Resource('error'));
    //Finally, we want to allow guests to view pages
    $this->allow('guest', 'index');
    $this->allow('guest', 'error');
 
    //and users can comment news
    $this->allow('user', 'user');
    $this->allow('admin', 'admin');
  }
}