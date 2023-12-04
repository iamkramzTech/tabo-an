<?php 
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php
 $vendorID = $_SESSION['vendor'];
$query = "
SELECT 
    p.*,
    b.brand_name AS brand_name,
    c.name AS category_name,
    pi.product_image
FROM 
    products p
JOIN 
    brand b ON p.brand_id = b.brand_id
JOIN 
    category c ON p.category_id = c.category_id
LEFT JOIN 
    productimages pi ON p.product_id = pi.product_id
WHERE 
    p.vendor_id = :vendorID;
";

//Prepare the statement
$statement = $dbConn->prepare($query);

//Bind parameter
$statement->bindparam(':vendorID', $vendorID,PDO::PARAM_INT);
//execute Query
$statement->execute();

// Fetch all rows as an associative array
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!--Fetch all brand added by admin-->

<?php

    //Fetch all brands added by admin
    $sql_brand = "SELECT * FROM brand";
    $statement = $dbConn->prepare($sql_brand);

    //execute Query
    $statement->execute();

    // Fetch all rows as an associative array
    $brands = $statement->fetchAll(PDO::FETCH_ASSOC);

 ?>
 <!--/Fetch all brand added by admin-->

 <!--Fetch all category added by admin-->

<?php

$sql_category = "SELECT * FROM category";
$statement = $dbConn->prepare($sql_category);

//execute Query
$statement->execute();

// Fetch all rows as an associative array
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!--/Fetch all category added by admin-->
<?php include('../merchants/includes/header.php')?>
<body>
<?php include(__DIR__ . '/../merchants/includes/nav.php');?>
<div class="container-fluid">
<?php include(__DIR__ . '/../merchants/includes/sidenav.php');?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="content">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2">Product List</h2>
</div>

<div class="table-responsive">
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Product Name</th>
              <th scope="col">slug</th>
              <th scope="col">Description</th>
              <th scope="col">Quantity</th>
              <th scope="col">Category</th>
              <th scope="col">price</th>
              <th scope="col">Brand</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

        <tbody>
            <?php foreach ($products as $index=>$product):?>
            <tr>
            <td><?=$index+1?></td>
              <td><?=$product['product_name']?></td>
              <td><?=$product['slug']?></td>
              <td><?=$product['short_desc']?></td>
              <td><?=$product['quantity']?></td>
              <td><?=$product['category']?></td>
              <td><?=$product['price']?></td>
              <td><?=$product['brand']?></td>
              <td><?=$product['product_image']?></td>
              <td>
                <button type="button" id="edit" class="btn btn-success mr-auto" data-id="">Edit</button>
                <button type="button" id="delete" class="btn btn-danger" data-id="">Delete</button>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
</table>    

</div> 


</main>
</div>
<?php include(__DIR__ . '/../merchants/includes/footer.php');?>
</body>




