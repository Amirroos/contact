<?php
echo "test" ;
$servername = "mysql";
$username = "root";
$password = "123456";
global $conn;
$body = file_get_contents('php://input');
$data = json_decode($body);
global $data;
header('Content-Type: application/json');
try {    
        $conn = new PDO("mysql:host=$servername;dbname=contact", $username, $password);                        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $tableName = 'moreinfo'; 
                $id = 1 ; 
                // $user['id'];
                echo "test" ;
                $searchUsername = $id; 
                
                $query = "SELECT * FROM $tableName WHERE name = :searchUsername";
                
                $stmt = $conn->prepare($query);
                
                $stmt->bindParam(':searchUsername', $searchUsername, PDO::PARAM_STR);
                echo "test";
                $stmt->execute();
                

                $moreinfo = $stmt->fetch(PDO::FETCH_ASSOC);
                echo $moreinfo['fildname'];
}catch (PDOException $e) {
    echo "خطا: " . $e->getMessage();
}
?>