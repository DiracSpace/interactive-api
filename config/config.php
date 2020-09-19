<?php
   // MySQL database connection class
   class Database {
      private $host = "DB-IP";
      private $database_name = "DB-NAME";
      private $username = "DB-USER";
      private $password = "DB-PASSWORD";
      public $conn;

      public function getConnection(){
         $this -> conn = null;
         try {
            $this -> conn = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this -> database_name, $this -> username, $this -> password);
            $this -> conn -> exec("set names utf8");
         } catch(PDOException $exception) {
            echo "Database could not be connected: " . $exception -> getMessage();
         }
         return $this -> conn;
      }
   }  
?>
