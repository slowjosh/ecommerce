<?php

session_start();
$username= $_POST["username"];
$password= $_POST["password"];



if($_SERVER["REQUEST_METHOD"]=="POST"){
  
    $host = "localhost";
    $database = "ecommerse";
    $dbusername = "root";
    $dbpassword = "";

    $dsn = "mysql: host=$host;dbname=$database;";
    try {
        $conn = new PDO($dsn, $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        $stmt = $conn->prepare('SELECT * FROM `users` WHERE username = :p_username'); 
        $stmt->bindParam(':p_username',$username);
        $stmt->execute();
        $user = $stmt->fetchAll();


        if($user){
            if(password_verify($password, $user[0]["password"])){
                header("location: /index.php");
                $_SESSION["fullname"]=$user[0]["fullname"];
                $_SESSION["right"]="Registration successful";
                exit;
            } else{
                header("location: /login.php");
                $_SESSION["wrong"]="Insert error";
                exit;
                    // hello world
            }

            
        }else{
            
            header("location: /login.php");
            $_SESSION["wrong"]="Insert error";
            exit;
        }
        
    
        
    } catch (Exception $e){
    echo "Connection Failed: " . $e->getMessage();
        }

        
           
    }  
                
        
?>