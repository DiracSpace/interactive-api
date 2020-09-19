<?php
    // students class manages the CRUD operations 
    class Students {
        public $name, $email, $age, $birthday;
        public $db_table = "registered_students";

        // preparation of database connection
        private $db;
        public function __construct($db) {
            $this -> conn = $db;
        }

        // queries
        // gets all records from certain table
        public function getAllStudents() {
            $sqlQuery = "select * from " . $this -> db_table . "";
            $stmt = $this -> conn -> prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // get single record from certain table
        public function getStudent() {
            $sqlQuery = "select * from " . $this -> db_table . " where id = 3 limit 0,1";
            $stmt = $this -> conn -> prepare($sqlQuery);
            $stmt -> bindParam(1, $this -> id);
            $stmt -> execute();
            $dataRow = $stmt -> fetch(PDO::FETCH_ASSOC);

            // bind data
            $this -> name = $dataRow['name'];
            $this -> email = $dataRow['email'];
            $this -> age = $dataRow['age'];
            $this -> birthday = $dataRow['birthday'];
        }

        // create a new record in certain table
        public function addStudent() {
            $sqlQuery = "insert into " . $this -> db_table . " set name = :name, email = :email, age = :age, birthday = :birthday";
            $stmt = $this -> conn -> prepare($sqlQuery);

            // sanitize and validate
            $this -> name = htmlspecialchars(strip_tags($this -> name));
            $this -> email = htmlspecialchars(strip_tags($this -> email));
            $this -> age = htmlspecialchars(strip_tags($this -> age));
            $this -> birthday = htmlspecialchars(strip_tags($this -> birthday));

            // binding data
            $stmt -> bindParam(":name", $this -> name);
            $stmt -> bindParam(":email", $this -> email);
            $stmt -> bindParam(":age", $this -> age);
            $stmt -> bindParam(":birthday", $this -> birthday);

            // run query
            return ($stmt -> execute()) ? True : False;
        }
    }
?>