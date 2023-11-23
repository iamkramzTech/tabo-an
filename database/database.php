<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/config/config.php');

try {

    $dbConn = new PDO("mysql:host=".DB_HOST.";dbname=" .DB_NAME,DB_USER,DB_PASSWORD);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connection established';

} catch (PDOException $e) {
    echo 'Connection error: '.$e->getMessage();
}
?>


<?php

/*Code example from w3school*/
// $servername = "localhost";
// $username = "username";
// $password = "password";

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }
?>