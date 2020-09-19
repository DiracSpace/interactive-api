<?php
    // get request parameters
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // configuration and class files
    include_once '../config/config.php';
    include_once '../class/students.php';

    $database = new Database();
    $db = $database -> getConnection();

    $items = new Students($db);

    $stmt = $items -> getAllStudents();
    $itemCount = $stmt -> rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $studentsArr = array();
        $studentsArr["body"] = array();
        $studentsArr["itemCount"] = $itemCount;

        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resultData = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "age" => $age,
                "birthday" => $birthday
            );
            array_push($studentsArr["body"], $resultData);
        }
        echo json_encode($studentsArr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>