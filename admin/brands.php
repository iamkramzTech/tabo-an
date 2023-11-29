<?php 
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/database/database.php');?>
<?php
//brands code
// FETCH data from the "brands" table
$query = "SELECT * FROM brand";

//Prepare the statement
$statement = $dbConn->prepare($query);

//execute Query
$statement->execute();

// Fetch all rows as an associative array
$brands = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Brands</h2>
<button type="button" id="addBrandButton" class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">
                <span data-feather="plus-circle" class="align-text-bottom"></span>+New Brand
</button>
<div class="table-responsive">
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Brand Name</th>
              <th scope="col">slug</th>
              <th scope="col">Photo</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

        <tbody>
            <?php foreach ($brands as $index=>$brand):?>
            <tr>
            <td><?=$index+1?></td>
              <td><?=$brand['brand_name']?></td>
              <td><?=$brand['brand_slug']?></td>
              <td><?=$brand['brand_image']?></td>
              <td>
                <button type="button" id="update" class="btn btn-success mr-auto">Update</button>
                <button type="button" id="delete" class="btn btn-danger">Delete</button>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
</table>    

</div> 

<!--Add Brand Modal-->

<!-- Modal for adding new brand -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding a new brand goes here -->
                <!-- For example: -->
                <form action="add-brand.php" method="POST" id="addBrandForm" enctype="multipart/form-data">
                <div class="form-floating mb-4">
                   
                    <input type="text" class="form-control" name="brandName" id="brandName" required>
                    <label for="brandName">Brand Name:</label>
                    </div>
                    <div class="form-floating mb-4">
                    
                    <input type="file" accept="image/png, image/jpeg" class="form-control" name="brandImage" id="brandImage" required>
                    <label for="brandName">Choose Image:</label>   
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
$("#addBrandForm").submit(function(e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();

    // Submit the form using AJAX
    $.ajax({
        type: "POST",
        url: "add-brand.php",
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
                $('#addBrandModal').modal('hide');
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


