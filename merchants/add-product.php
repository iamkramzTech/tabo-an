<?php require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/database/database.php');?>
<?php
 include($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/slugify.php');
?>

<?php

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Validate and sanitize input (you should customize this based on your requirements)
    $productName = filter_var($_POST["productName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $slug = slugify($productName);
    $desc = filter_var($_POST["productdesc"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $qty = $_POST['qty'];
    $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);
    $category = $_POST['category'];
    
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