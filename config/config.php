<?php

class config{
    

 public function openDb() {
      
        if (!mysql_connect("127.0.0.1:3307", "root", "")) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("logindb")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
    }
    
    public function closeDb() {
        mysql_close();
    }
}
?>