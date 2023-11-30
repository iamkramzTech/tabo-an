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

<h2>Products</h2>
<button type="button" id="addProductButton" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                <span data-feather="plus-circle" class="align-text-bottom"></span>+New Product
</button>
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
                <button type="button" id="update" class="btn btn-success mr-auto">Update</button>
                <button type="button" id="delete" class="btn btn-danger">Delete</button>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
</table>    

</div> 

<!--Add Product Modal-->

<!-- Modal for adding new Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding a new Product goes here -->
                <!-- For example: -->
                <form action="add-product.php" method="POST" id="addProductForm" enctype="multipart/form-data">
                <div class="form-floating mb-4">
                   
                    <input type="text" class="form-control" name="productName" id="productName" required>
                    <label for="productName">Product Name:</label>
                    </div>
                    <div class="form-floating mb-4">
                   
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="productdesc" style="height: 100px" required></textarea>
                    <label for="productName">Description:</label>
                    </div>
                    <div class="form-floating mb-4">
                   
                    <input type="number" class="form-control" name="qty" id="qty" required>
                    <label for="productName">Quantity:</label>
                    </div>
                    <div class="form-floating mb-4">
                   
                    <input type="text" class="form-control" name="price" id="price" required>
                    <label for="productName">Price $0.00:</label>
                    </div>

                    <div class="form-floating mb-4">
                    <select class="form-select" id="category" name="category" aria-label="Floating label select example">
                     <option selected>--Choose Category--</option>
                    <option value="1">Uncategorized</option>
                    </select>
                    <!-- <label for="productName">Product Name:</label> -->
                    </div>
                    <div class="form-floating mb-4">
                    <select class="form-select" id="brand" name="brand" aria-label="Floating label select example">
                     <option selected>--Choose Brand--</option>
                    <option value="1">No Brand/option>
                    </select>
                    <!-- <label for="productName">Product Name:</label> -->
                    </div>
                    <div class="form-floating mb-4">
                    
                    <input type="file" accept="image/png, image/jpeg" class="form-control" name="productImage[]" id="ProductImage" multiple required>
                    <label for="productImage">Choose Image:</label>   
                </div>
                    <!-- Add other form fields as needed -->
                 <!-- Display success or error messages here -->
                 <div id="messageContainer"></div>
            
            <div class="modal-footer">
            
            <button type="submit" name="save" id="save" class="btn btn-primary py-2 mr-auto">Save</button>
            <button type="button" id="cancel" data-bs-dismiss="modal" class="btn btn-secondary py-2">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>

<?php include('../admin/includes/adminfooter.php')?>


<!--JQuery Code to handle form submission -->
<script>
$(document).ready(function() {
$("#addProductForm").submit(function(e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();

    // Submit the form using AJAX
    $.ajax({
        type: "POST",
        url: "add-product.php",
        data: formData,
        dataType: "json",
        success: function(response) {
        // Display success or error message
        if (response.status === "success") 
        {
            $("#messageContainer").html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
            // Optionally, close the modal after success
            setTimeout(function() 
            {
                $('#addProductModal').modal('hide');
            }, 2000); // Close the modal after 2 seconds
        }
        else 
        {
            $("#messageContainer").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
        }
            },
            error: function() {
                $("#messageContainer").html('<div class="alert alert-danger" role="alert">An unexpected error occurred.</div>');
            }
        });
    });
});
</script>


