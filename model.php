<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author mad
 */
class model
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {

        $dbOptions = require './config/setting.php';

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
        
    }
    
    public static function getInstance() 
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * 
     * @param type $login
     * @return type
     */
    public function getContacts($login)
    {
        try {
            $sql = 'SELECT * FROM contacts';
            $sth = $this->pdo->prepare($sql);
//            $sth->bindValue(':contactsuser ', $i /*$_SESSION['login']*/);
            $result = $sth->execute();

            if (false === $result) {
                return null;
            }

            return $sth->fetchAll();
        } catch (PDOException $e) {
            d($e);
        }
    }
    
    public function deleteContacts($id)
    {
        try {
            $sql = 'DELETE FROM contacts WHERE idcontacts = ' . $id;
            $sth = $this->pdo->prepare($sql);
//            $sth->bindParam(':id ', $id, PDO::PARAM_STR);
            $result = $sth->execute();
            if (false === $result) {
                return null;
            }

            return true;
        } catch (PDOException $e) {
            d($e);
        }
    }
    
    public function setContact($name, $phone) {
        try {
            $sql = 'INSERT INTO contacts(contactsname, contactsphone, contactsuser) '
                . 'VALUES (:contactsname, :contactsphone, :contactsuser)';
            $sth = $this->pdo->prepare($sql);
            $sth->bindParam(':contactsname', $name, PDO::PARAM_STR);
            $sth->bindParam(':contactsphone', $phone, PDO::PARAM_STR);
            $sth->bindParam(':contactsuser', $_SESSION['login'], PDO::PARAM_STR);
            $result = $sth->execute();

            if (false === $result) {
                return null;
            }

            return true;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }  
        
    }
    
}
