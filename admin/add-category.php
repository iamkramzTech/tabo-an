<?php 
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/database/database.php');?>
<?php

 $file = $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/slugify.php';
//  print_r($file);
 include($file);
?>

<?php

// $brand_name = 'Nestle';

// $slug = slugify($brand_name);

// print_r($slug);
// print_r($dbConn);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Validate and sanitize input (you should customize this based on your requirements)
    $categoryName = filter_var($_POST["categoryName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $slug = slugify($categoryName);
    
    // Insert data into the "brands" table
    $query = "INSERT INTO category(name, slug) VALUES (:categoryName, :slug)";

    //Prepare the statement
    $statement = $dbConn->prepare($query);
    
    //Bind parameter
    $statement->bindParam(':categoryName',$categoryName, PDO::PARAM_STR);
    $statement->bindParam(':slug',$slug, PDO::PARAM_STR);
    //execute Query
    $statement->execute();

    // $stmt = $conn->prepare("INSERT INTO tblnname (brand_name) VALUES (:brandName)");
    // $stmt->bindParam(':brandName', $brandName, PDO::PARAM_STR);
    // $stmt->execute();

     $response = array("status" => "success", "message" => "Category added successfully!");
    echo json_encode($response);
} 
else
{
    $response = array("status" => "error", "message" => "Invalid request method.");
    echo json_encode($response);
}
?>
