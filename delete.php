<?php

 
 $servername = "mysql";
 $username = "root";
 $password = "123456";
 global $conn;
 $body = file_get_contents('php://input');
 $data = json_decode($body);
 global $data;
 header('Content-Type: application/json');
     try {
        // $JSON = array(
        // 'status' => true 
        // );
        $conn = new PDO("mysql:host=$servername;dbname=contact", $username, $password);
    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "DELETE FROM moreinfo WHERE id = '$data->id'";
    
        $conn->exec($sql);
        // echo json_encode($JSON);

    }   catch(PDOException $e) {

        echo $sql . "<br>" . $e->getMessage();
    }
    try {
        $JSON = array(
            'status' => true 
            );
        $conn = new PDO("mysql:host=$servername;dbname=contact", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM contact WHERE id = '$data->id'";
        
        $conn->exec($sql);
            echo json_encode($JSON);
    
    }   catch(PDOException $e) {
  
            echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>