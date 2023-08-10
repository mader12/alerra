<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author mad
 */
class controller
{
    public $model;
    public $login;
    public $contacts;
    
    public function __construct()
    {
        $this->model = model::getInstance();
        
        if (!empty($_POST)) {
            $this->isPost();
        }
        
        
        if (!empty($_SESSION['login'])) {
            $this->contacts = $this->model->getContacts($_SESSION['login']);
        }
        
    }
    
    public function isPost() {

        if (!empty($_POST['login'])){
            $_SESSION['login'] = $_POST['login'];
        } elseif (!empty($_POST['unlogin'])) {
            unset($_SESSION['login']);
        } elseif (!empty($_POST['ContactSave'])) {
            $this->model->setContact($_POST['name'], $_POST['phone']);
        } elseif (!empty($_POST["ContactDel"])) {
            $this->model->deleteContacts($_POST['id']);
        }

    }
    
}
