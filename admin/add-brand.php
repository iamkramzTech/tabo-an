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

/** --------------------------------
 * 
 * “When I wrote this code, only God and I understood what I did. Now only God knows.”
 * 
 *  Total time waste: 24 hours
 * ----------------------------------
**/


// $brand_name = 'Nestle';

// $slug = slugify($brand_name);

// print_r($slug);
// print_r($dbConn);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Validate and sanitize input (you should customize this based on your requirements)
    $brandName = filter_var($_POST["brandName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $slug = slugify($brandName);
    $brandImage = $_FILES['brandImage']['name'];
    $uploadDir = '../wp-image/';

    $ext = pathinfo($brandImage, PATHINFO_EXTENSION);
    $newFileName = $slug.'.'.$ext;

    //check if the file was uploaded without errors
    if($_FILES['brandImage']['error']==UPLOAD_ERR_OK)
    {
       
        $uploadPath = $uploadDir .$newFileName;

        // Move the uploaded file to the desired location
        move_uploaded_file($_FILES['brandImage']['tmp_name'], $uploadPath);
    }
    
    // Insert data into the "brands" table
    $query = "INSERT INTO brand(brand_name, brand_image, brand_slug) VALUES (:brandName, :brandImage, :slug)";

    //Prepare the statement
    $statement = $dbConn->prepare($query);
    
    //Bind parameter
    $statement->bindParam(':brandName',$brandName, PDO::PARAM_STR);
    $statement->bindParam(':brandImage',$brandImage, PDO::PARAM_STR);
    $statement->bindParam(':slug',$slug, PDO::PARAM_STR);
    //execute Query
    $statement->execute();

    // $stmt = $conn->prepare("INSERT INTO tblnname (brand_name) VALUES (:brandName)");
    // $stmt->bindParam(':brandName', $brandName, PDO::PARAM_STR);
    // $stmt->execute();

     $response = array("status" => "success", "message" => "Brand added successfully!");
    echo json_encode($response);
} 
else
{
    $response = array("status" => "error", "message" => "Invalid request method.");
    echo json_encode($response);
}
?>
