<?php


class UserGateway {
    
    
    public function insert( $username, $password, $confirm_password,$typeofuser) {
      
        
        $dbName = ($username != NULL)?"'".mysql_real_escape_string($username)."'":'NULL';
        $dbPassword = ($password != NULL)?"'".mysql_real_escape_string($password)."'":'NULL';
        $dbconfirmpassword = ($confirm_password!= NULL)?"'".mysql_real_escape_string($confirm_password)."'":'NULL';
       $dbtypeofuser = ($typeofuser!= NULL)?"'".mysql_real_escape_string($typeofuser)."'":'NULL';
        
     
        mysql_query("INSERT INTO userdetails (name, password,confirmpassword,typeofuser) VALUES ($dbName, $dbPassword, $dbconfirmpassword,$dbtypeofuser)");
        return mysql_insert_id();
        
        
    }
     public function selectByUsername($username, $password) {
       
        
        $link = mysqli_connect("127.0.0.1:3307", "root", "", "logindb");
        $sql = mysql_query("SELECT username,password FROM userdetails WHERE  username = ? AND password = ?");
         if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ss", $dbusername,$dbpassword);
          
            // Set parameters
            $dbusername = $username;
             $dbpassword= $password;
        
        return mysql_fetch_object($stmt);
		
    }
     }
}
    ?>
    