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
/** --------------------------------
 * 
 * “When I fixed this code, only God and I understood what I did. Now only God knows.”
 * 
 *  Total time waste: 5 mins.
 * ----------------------------------
**/
?>