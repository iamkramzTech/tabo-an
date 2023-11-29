<?php 
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/database/database.php');?>
<?php
//brands code
// FETCH data from the "brands" table
$query = "SELECT * FROM category";

//Prepare the statement
$statement = $dbConn->prepare($query);

//execute Query
$statement->execute();

// Fetch all rows as an associative array
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Categories</h2>
<button type="button" id="addCategoryButton" class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">
                <span data-feather="plus-circle" class="align-text-bottom"></span>+New Category
</button>
<div class="table-responsive">
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Category Name</th>
              <th scope="col">slug</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

        <tbody>
            <?php foreach ($categories as $index=>$category):?>
            <tr>
            <td><?=$index+1?></td>
              <td><?=$category['name']?></td>
              <td><?=$category['slug']?></td>
              <td>
                <button type="button" id="update" class="btn btn-success mr-auto">Update</button>
                <button type="button" id="delete" class="btn btn-danger">Delete</button>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
</table>    

</div> 

<!--Add Category Modal-->

<!-- Modal for adding new brand -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding a new brand goes here -->
                <!-- For example: -->
                <form action="add-category.php" method="POST" id="addCategoryForm" enctype="multipart/form-data">
                <div class="form-floating mb-4">
                   
                    <input type="text" class="form-control" name="categoryName" id="categoryName" required>
                    <label for="categoryName">Category Name:</label>
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
$("#addCategoryForm").submit(function(e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();

    // Submit the form using AJAX
    $.ajax({
        type: "POST",
        url: "add-category.php",
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
                $('#addCategoryModal').modal('hide');
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


