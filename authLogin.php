    <?php


$username= $_POST["username"];
$password= $_POST["password"];

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
  
    $host = "localhost";
    $database = "ecommerce2";
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
                echo"login successfull"  ;
                $_SESSION["fullname"]=$user[0]["fullname"];
               } else{
                    echo "password not match";



                    // hello world
                }

            
            }else{
            echo"user not exist";
        }
        
    
        
    } catch (Exception $e){
    echo "Connection Failed: " . $e->getMessage();
        }

        
           
    }  
                
        
?>