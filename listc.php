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
                
                $searchUsername = $data->name; 
                
                $query = "SELECT * FROM $tableName WHERE name = :searchUsername";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':searchUsername', $searchUsername, PDO::PARAM_STR);

                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    echo "id:" , $user['id'];
                    echo "\n";
                    echo "phone:" , $user['phone'];
                    echo "\n";
                    echo "address:" , $user['address'];
                    echo "\n";
                    echo "homenumber:" , $user['homenumber'];
                    echo "\n";
                    echo "postcode:" , $user['postcode'];
                    echo "\n";

                } else {
                    echo "dont find name";
                }
            } catch (PDOException $e) {
                echo "خطا: " . $e->getMessage();
            }
                $tableName = 'moreinfo'; 
                $id = $user['id'];
                
                $searchUsername = $id; 
                
                $query = "SELECT * FROM $tableName WHERE userid = :searchUsername";
                
                $stmt = $conn->prepare($query);
                
                $stmt->bindParam(':searchUsername', $searchUsername, PDO::PARAM_STR);
                
                $stmt->execute();

                $moreinfo = $stmt->fetch(PDO::FETCH_ASSOC);
                echo $moreinfo['fildname'] , ":";
                echo $moreinfo['value'];

            ?>