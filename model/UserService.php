<?php

require_once 'model/UserGateway.php';
require_once 'model/ValidationException.php';
require_once 'config/config.php';


class UserService 
{
     private $userGateway    = NULL;
     private $configdb = NULL;
    
 
    public function __construct() {
        $this->userGateway = new UserGateway();
           $this->configdb = new config();
        
    
    }  
         public function createNewuser( $username, $password, $confirm_password,$typeofuser) {
        try {
          
            $this->configdb->openDb();
       
           
            $res = $this->userGateway->insert($username, $password, $confirm_password,$typeofuser);
            $this->configdb->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->configdb->closeDb();
            throw $e;
        }
    }
    
      public function  getcontacts($username,$password) {
        try {
            $this->configdb->openDb();
            $res = $this->userGateway->selectByUsername($username,$password);
            $this->configdb->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->configdb->closeDb();
            throw $e;
        }
       
}
    
     
    
}
?>
    