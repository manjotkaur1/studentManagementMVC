<?php
 require_once 'dashboardController.php';
 require_once 'model/UserService.php';
class UserController {
        private $UserService = NULL;
    
    public function __construct() {
        $this->UserService = new UserService();
    }
   public function handleRequest() {
   if($_SERVER["REQUEST_METHOD"] == "GET"){
     $method = isset($_GET['method'])?$_GET['method']:NULL;
        try {
            if ( $method=='register' ) {
                $this->register();
        
            }else {
                $this->showError("Page not found", "Page for operation ".$method." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
       
   }else
   {
       
       $methodpost = isset($_POST['method'])?$_POST['method']:NULL;
  
         try {
            if ( $methodpost == 'doRegister' ) {
             $this->doRegister();
            }elseif ( $methodpost == 'userlogin' ) {
               $this->login();
            } 
            else {
                $this->showError("Page not found", "Page for operation ".$methodpost." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
   }
   }
   public function register() {
      
          
           include 'view/register.php';
          
      
      
   }
      public function login() {
        if ( isset($_POST['form-submitted']) ) {
            echo"login";
            $username      = isset($_POST['username']) ?   $_POST['username']  :NULL;
            $password     = isset($_POST['password'])?   $_POST['password'] :NULL;
            try{
              $stmt=  $this->UserService->getcontacts($username, $password);
                 if(mysqli_stmt_execute($stmt)){
                  
                // Store result
                mysqli_stmt_store_result($stmt);
              
                // Check if username and password  exists, 
                if(mysqli_stmt_num_rows($stmt) == 1){  
                   
                           echo"welcome";
//                    
                } else{
                    // Display an error message if username doesn't exist
                    echo " The username and password is invalid .";
                }
                
                return;
            } 
            }catch (Exception $ex) {
            
            
        }
      
   }
        }
    public function doRegister() {
         if ( isset($_POST['form-submitted']) ) {
            $username      = isset($_POST['username']) ?   $_POST['username']  :NULL;
            $password     = isset($_POST['password'])?   $_POST['password'] :NULL;
             $confirm_password  = isset($_POST['confirm_password'])?   $_POST['confirm_password'] :NULL;
             $typeofuser    = isset($_POST['typeofuser'])?   $_POST['typeofuser'] :NULL;

              try {
                $this->UserService->createNewuser($username, $password, $confirm_password,$typeofuser);
                           
                $this->redirect('index.php');
                return;
                } catch (ValidationException $e) {
                     $errors = $e->getErrors();
            }
        }
        
      }
}
 ?>