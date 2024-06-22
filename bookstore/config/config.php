<?php 

//host
$host = "localhost";

//dbname
$dbname = "bookstore";

//username
$user = "root";

//password

$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$secret_key = "sk_test_51PUFIvFyRKF8Nw4QSiZdSWYCQ3n8eddWAmhCs7Tn9AWIBMwNVlZ6QEL5ruSh8vKdPGhmN69sBRjDOwrpuq52cr9b00SKiwJsJJ";

//if($conn) {
  //  echo "Connected successfully";
//}
//else {
//    echo "Connection failed";
//}