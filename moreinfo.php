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
    
            $queryGetname = "SELECT name FROM contact WHERE id = :nameid";
                $stmtGetname = $conn->prepare($queryGetname);
    
        $nameid= 1; 
        $stmtGetname->bindParam(':nameid', $nameid, PDO::PARAM_INT);
            $stmtGetname->execute();

        $result = $stmtGetname->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                
                $name = $result['name'];
                $newData = "mothernumber"; 


                $queryInsertData = "INSERT INTO moreinfo (name, data) VALUES (:name, :data)";
                $stmtInsertData = $conn->prepare($queryInsertData);
                echo "slm";
        
                $stmtInsertData->bindParam(':name', $username, PDO::PARAM_STR);
                $stmtInsertData->bindParam(':data', $newData, PDO::PARAM_STR);
                    $stmtInsertData->execute();
        
        echo "اطلاعات با موفقیت به جدول دیگر اضافه شد.";
    } else {
        echo "نام کاربری با این ایدی وجود ندارد.";
    }
} catch (PDOException $e) {
    echo "خطا: " . $e->getMessage();
}
?>
