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

                $moreinfo = 'moreinfo'; 
                $contact = 'contact';
    
            $moreinfoForeignKeyName = 'foreign';     
            $contactPrimaryKeyName = 'id';


 
            $query = "ALTER TABLE $moreinfo
                    ADD CONSTRAINT fk_$moreinfoForeignKeyName
                    FOREIGN KEY ($moreinfoForeignKeyName) REFERENCES $contact($contactPrimaryKeyName)";
    
            $conn->exec($query);
                echo "کلید خارجی با موفقیت به جدول اضافه شد.";
        
        }   catch (PDOException $e) {
                echo "خطا: " . $e->getMessage();
            }
?> 