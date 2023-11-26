<?php
//brands code
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
            <tr>
            <td>1</td>
              <td>Sample Brand</td>
              <td>sample-brand</td>
              <td>photo.jpeg</td>
              <td><button type="button">View</button></td>
            </tr>
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
                <form action="add_brand.php" method="post">
                <div class="form-floating mb-4">
                   
                    <input type="text" class="form-control" name="brandName" id="brandName" required>
                    <label for="brandName">Brand Name:</label>
                    </div>
                    <div class="form-floating mb-4">
                    
                    <input type="file" accept="image/png, image/jpeg" class="form-control" name="brandImage" id="brandImage" required>
                    <label for="brandName">Choose Image:</label>   
                </div>
                    <!-- Add other form fields as needed -->
                
            </div>
            <div class="modal-footer">
            
            <button type="submit" name="submit" id="submit" class="btn btn-primary py-2 mr-auto">Save</button>
            <button type="button" id="cancel" data-bs-dismiss="modal" class="btn btn-secondary py-2">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
<?php include('../admin/includes/adminfooter.php')?>


