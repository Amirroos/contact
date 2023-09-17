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

            $x1 = $data->name;
            $x2 = $data->phone;
            $x3 = $data->address;
            $x4 = $data->homenumber;
            $x6 = $data->postcode;
            $x7 = $data->fildname;
            $x8 = $data->value;
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
                $query = "SELECT * FROM contact WHERE id = :id";
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
               
                $sql = "UPDATE contact SET name='$data->name' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $JSON = array(
                    'status' => true 
                );
            }

            if($x2 != NULL)
            {
                
                $sql = "UPDATE contact SET phone='$data->phone' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $JSON = array(
                    'status' => true 
                );
            }

            if($x3 != NULL)
            {
                
                $sql = "UPDATE contact SET address='$data->address' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                $JSON = array(
                    'status' => true 
                );
            }

            if($x4 != NULL)
            {
                
                $sql = "UPDATE contact SET homenumber='$data->homenumber' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $JSON = array(
                    'status' => true 
                );
            }

            if($x6 != NULL)
            {
                
                $sql = "UPDATE contact SET postcode='$data->postcode' WHERE id = '$data->id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $JSON = array(
                    'status' => true 
                );
            }
// ************************************************************************************************************
            if($x7 != NULL)
            {
                
                $sql = "UPDATE moreinfo SET value='$data->value' WHERE fildname = '$data->fildname'AND id = '$data->id'";
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