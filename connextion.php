<?php      
$host = "localhost";  
$user = "root";  
$password = "";  
$db_name = "modeco";  


$con = mysqli_connect($host, $user, $password, $db_name);


if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
