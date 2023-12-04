<?php 

include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';
?>
<?php
 include($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/slugify.php');
?>

<!--/Insert Query-->
<?php
 

if(isset($_POST['addProduct']))
{
    // Validate and sanitize input (you should customize this based on your requirements)
    $productName = filter_var($_POST["productName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $slug = slugify($productName);
    $desc = filter_var($_POST["productDesc"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $photo = $_FILES['productPhotos']['name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];

    $vendor_shop_id = $_SESSION['vendor_shop_id'];
  
    if(empty($productName) ||empty($desc) || empty($qty) || empty($price) || empty($brand) || empty($brand) || empty($category))
    {
        // Handle validation error, set errors in session
        $_SESSION['errors'] = ['All fields are required'];
    }
    else
    {
       

        //check if product already exists
        $statement = $dbConn->prepare("SELECT COUNT(*) AS productRows FROM products WHERE slug=:slug AND vendor_id=:vendor_id");
        $statement->bindParam(':slug',$slug,PDO::PARAM_STR);
        $statement->bindParam(':vendor_id',$vendor_shop_id,PDO::PARAM_INT);
        $statement->execute();

        $prodExist = $statement->fetch(PDO::FETCH_ASSOC);

        if($prodExist['productRows']>0)
        {
            $_SESSION['errors'] = ['product already exist'];
        }
        else
        {
            // Insert data into the "products" table
            $query = "INSERT INTO products(product_name, slug, short_description, quantity, price, category_id, brand_id, vendor_id) VALUES (:product_name, :slug, :short_desc, :quantity, :price, :category_id, :brand_id, :vendor_id)";

            //Prepare the statement
            $statement = $dbConn->prepare($query);
            
            //Bind parameter
            $statement->bindParam(':product_name',$productName, PDO::PARAM_STR);
            $statement->bindParam(':slug',$slug, PDO::PARAM_STR);
            $statement->bindParam(':short_desc',$desc, PDO::PARAM_STR);
            $statement->bindParam(':quantity',$qty, PDO::PARAM_INT);
            $statement->bindParam(':price',$price);
            $statement->bindParam(':category_id', $category,PDO::PARAM_INT);
            $statement->bindParam(':brand_id', $brand,PDO::PARAM_INT);
            $statement->bindParam(':vendor_id', $vendor_shop_id,PDO::PARAM_INT);

            //execute Query
            $statement->execute();

             // Retrieve the last inserted user ID
             $productID = $dbConn->lastInsertId();


            // Handle multiple product images upload
             $uploadDir = '../wp-image/';

             if (count($_FILES['productPhotos']['name']) > 0)
             {
                 // Perform the insertion into the 'productImage' table
                 $insertImgQuery = "INSERT INTO productimages(product_image, product_id) VALUES (:product_image, :product_id)";
                 $stmt = $dbConn->prepare($insertImgQuery);
                foreach($_FILES['productPhotos']['tmp_name'] as $key=>$tmp_name)
                {
                    $productImages = $_FILES['productPhotos']['name'][$key];
                    $ext = pathinfo($productImages, PATHINFO_EXTENSION);
                    $newFileName = $slug . '_' . $key . '.' . $ext;

                    // Check if the file was uploaded without errors
                    if($_FILES['productPhotos']['error'][$key]==UPLOAD_ERR_OK)
                    {
                        $uploadPath = $uploadDir . $newFileName;

                         // Move the uploaded file to the desired location
                         move_uploaded_file($tmp_name, $uploadPath);
                         $stmt->bindParam(':product_image',$newFileName);
                         $stmt->bindParam(':product_id',$productID);
     
                         //execute insert query productimages
                         $stmt->execute();

                    }
                    else
                    {
                        $_SESSION['errors'] = ['Failed to upload Images'];
                    }
                }
             }
             else
             {
                $_SESSION['errors'] = ['No Files were uploaded!'];
             }

             $_SESSION['success'] = ['Product added successfully!'];
        }
    }
}
// Display errors, if any
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']); // Clear errors from session

//Display success, if any
$success = isset($_SESSION['success']) ? $_SESSION['success'] : [];
unset($_SESSION['success']); // Clear success from session
?>
<!--/Insert Query-->

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
<?php include('../merchants/includes/header.php')?>
<!--/Fetch all category added by admin-->
<body>
<?php include(__DIR__ . '/../merchants/includes/nav.php');?>

<div class="container-fluid">
  
  <?php include(__DIR__ . '/../merchants/includes/sidenav.php');?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="content">
       <!-- Main Content -->
          <div class="col-md-9">
                       <!-- Display errors, if any -->
       <?php if (!empty($errors)): ?>
                          <div class="alert alert-danger">
                              <ul>
                                  <?php foreach ($errors as $error): ?>
                                      <li><?php echo $error; ?></li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>
      <?php endif; ?>
  
         <!-- Display sucess message, if any -->
         <?php if (!empty($success)): ?>
                          <div class="alert alert-success">
                              <ul>
                                  <?php foreach ($success as $message): ?>
                                      <li><?php echo $message; ?></li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>
      <?php endif; ?>
              <div class="card mt-3">
                  <div class="card-header">
                      <h3 class="card-title">Add Product</h3>
                  </div>
                  <div class="card-body">
                      <form id="addProductForm" method="POST" enctype="multipart/form-data">
                          <!-- Form content remains the same as before -->
  
                          <!-- Example: Reducing the width of the form fields -->
                          <div class="mb-3">
                              <label for="productName" class="form-label">Product Name</label>
                              <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" required>
                          </div>
  
                       <div class="mb-3">
                      <label for="productDesc" class="form-label">Product Description</label>
                      <textarea class="form-control" id="productDesc" name="productDesc" placeholder="Description..." rows="3"></textarea>
                  </div>
  
       <!-- Add support for multiple photos -->
                          <div class="mb-3">
                              <label for="productPhotos" class="form-label">Product Photos</label>
                              <input type="file" class="form-control" id="productPhotos" name="productPhotos[]" multiple accept="image/*" required>
                          </div>
                       <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="quantity" class="form-label">Quantity</label>
                          <input type="number" class="form-control" id="quantity" name="quantity" placeholder="No." required>
                      </div>
      
                      <div class="col-md-6 mb-3">
                          <label for="price" class="form-label">Price</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="PHP 0.00" required>
                      </div>
  
                      <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="brand" class="form-label">Brand</label>
                          <select class="form-select" id="brand" name="brand" aria-label="Floating label select example">
                          <option selected disabled>--Choose Brand--</option>
                          <?php foreach ($brands as $index=>$brand):?>
                          <option value="<?=$brand['brand_id']?>"><?=$brand['brand_name']?></option>
                          <?php endforeach; ?>
                       </select>
                       </div>
                  
  
                          <div class="col-md-6 mb-3">
                          <label for="category" class="form-label">Category</label>
                          <select class="form-select" id="category" name="category" aria-label="Floating label select example">
                          <option selected disabled>--Choose Category--</option>
                          <?php foreach ($categories as $index=>$cat):?>
                          <option value="<?=$cat['category_id']?>"><?=$cat['name']?></option>
                          <?php endforeach; ?>
                          </select>
                      </div>
                       <!-- Display success or error messages here -->
                   <!-- <div id="messageContainer">
                     
                   </div> -->
  
                  <!-- <div class="mb-3">
                      <label for="productStatus" class="form-label">Product Status</label>
                      <select class="form-select" id="productStatus" name="productStatus" placeholder="in-stock/out-stock">
                          <option value="1">in-stock</option>
                          <option value="0">out-stock</option>
                      </select>
                  </div> -->
                          <!-- ... Other form fields ... -->
  
                          <button type="submit" class="btn btn-primary mr-auto" name="addProduct" id="addProduct">Add Product</button>
                      </form>
                  </div>
              </div>
          </div>
    </div>
  
      </main>
    </div>
  
  
  <?php
include(__DIR__ . '/../merchants/includes/footer.php');
?>
</body>