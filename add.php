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

            $conn = new PDO("mysql:host=$servername;dbname=contact", $username, $password);                        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $tableName = 'contact'; 
            
            $newColumnName = 'mothernumber';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $myVariable = $_POST["myVariable"];
            }    
            $dataType = 'INT';
    
            $query = "ALTER TABLE $tableName ADD $newColumnName $dataType";
            $conn->exec($query);
    
    echo $newColumnName ,"was added";
} catch (PDOException $e) {
    echo "خطا: " . $e->getMessage();
}
?>





