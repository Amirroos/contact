<?php
// show with id 
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
// *********************************************************************************************************
                $tableName = 'contact'; 
                $searchUsername = $data->name; 
                
                $query = "SELECT * FROM $tableName WHERE name = :searchUsername";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':searchUsername', $searchUsername, PDO::PARAM_STR);

                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);
// *********************************************************************************************************    
            $id = $user['id'];
            $sql = "INSERT INTO moreinfo (id , fildname, value)
            
            VALUES ( '$id' , '$data->fildname' , '$data->value')";
              $conn->exec($sql);
// *********************************************************************************************************
          $last_id = $conn->lastInsertId();
          $JSON = array(
            'userid' => $last_id,
            'id' => $id,
            'name'=> $data->name,
            'fildname' => $data->fildname,
            'value' => $data->value
          );
    

          echo json_encode($JSON,);

      } catch(PDOException $e) {
  
        echo "Connection failed: " . $e->getMessage();
      }