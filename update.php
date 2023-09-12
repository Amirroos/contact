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
            
            

            // if ("price"){
            // $sql = "UPDATE car SET pricce='$data->price' WHERE id = '$data->id'";
            // }else

            $x1 = $data->model;
            $x2 = $data->brand;
            $x3 = $data->year;
            $x4 = $data->price;
            $x5 = $data->id;

            if ($x5 == NULL){
                
                 $JSON = array(
                    'status' => false 
                );                
                echo "PLEASE INTER ID";
                echo "\n";
                // echo json_encode($JSON);                
                exit;
            }
            if ($x5!= NULL){
                $id = $x5;
                $query = "SELECT * FROM car WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    echo "ID corect";
                    echo "\n";
                } else {
                    echo "ID is not on database";
                    exit;
                }
            }
 
            if ($x1 != NULL )
            {
               
                $sql = "UPDATE car SET model='$data->model' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $JSON = array(
                    'status' => true 
                );
            }

            if($x2 != NULL)
            {
                
                $sql = "UPDATE car SET brand='$data->brand' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $JSON = array(
                    'status' => true 
                );
            }

            if($x3 != NULL)
            {
                
                $sql = "UPDATE car SET year='$data->year' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                $JSON = array(
                    'status' => true 
                );
            }

            if($x4 != NULL)
            {
                
                $sql = "UPDATE car SET pricce='$data->price' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $JSON = array(
                    'status' => true 
                );
            }


           


                
                
                echo json_encode($JSON);
                
                } catch(PDOException $e) {
            
                    echo $sql . "<br>" . $e->getMessage();

        }
      
       $conn = null;


?>