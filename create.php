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
        
            $sql = "INSERT INTO contact (name, phone, address, homenumber, postcode )
            
              VALUES ( '$data->name' , '$data->phone' , '$data->address' , '$data->homenumber', '$data->postcode')";
                $conn->exec($sql);

            $last_id = $conn->lastInsertId();
            $JSON = array(
              'id' => $last_id,
              'name' => $data->name,
              'phone' => $data->phone,
              'address' => $data->address,
              'homenumber' => $data->homenumber,
              'postcode' => $data->postcode
            );
      

            echo json_encode($JSON,);
  
        } catch(PDOException $e) {
    
          echo "Connection failed: " . $e->getMessage();
        }

?>