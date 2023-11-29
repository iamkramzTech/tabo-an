<?php
include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';


// if(!isset($_SESSION['vendor']) || trim($_SESSION['vendor'])=='')
// {
//    header("Location:../404");
// }
// else
// {
//     $fetchId = $_SESSION['vendor'];
// }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';?>

<?php


if(isset($_POST['submit']))
{
    $userId = $fetchId;
    $shopName = $_POST['shopname'];
    $shopDesc = $_POST['shopdesc'];

if(!empty($shopName) && !empty($shopDesc))
{
    //$_SESSION['success'] ='Successful';

    // Insert data into the "vendorShop" table
    $query = "INSERT INTO vendorshop(shop_name, Shop_description, user_id) VALUES (?,?,?)";

    //Prepare the statement
    $statement = $dbConn->prepare($query);
    
    //Bind parameter
   
    //execute Query
    $statement->execute([$shopName, $shopDesc,$userId]);

    $_SESSION['success'] ='Sucessful setup.';
    header('Location:merchants/dashboard');
    
}

else
{
    $_SESSION['error'] = 'All FIelds are Required';
}

}


?>
<!---

shop name

shop description

--photo join from users table

Fetch userid store in variable and insert in vendor user_id column
-->
<body>
<div class="d-flex align-items-center py-4 bg-body-tertiary">
<div class="container px-4 px-lg-5">
<div class="d-flex justify-content-center">
<div class="col-lg-6 col-md-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-5 px-md-5">
                    <?php
            if(isset($_SESSION['error']))
            {
            echo "
            <div class='text-center bg-danger text-white'>
            <p>".$_SESSION['error']."</p>
            </div>
            ";
            unset($_SESSION['error']);
          }
          if(isset($_SESSION['success'])){
            echo "
              <div class='callout callout-success text-center bg-success'>
                <p>".$_SESSION['success']."</p> 
              </div>
            ";
            unset($_SESSION['success']);
          }
      ?>
                        <main class="form-signin">
                            <img class="mb-4" src="/kramzcommerce/assets/logo/store-icon.jpg" alt="" width="72" height="57"/>
                            <h1 class="h3 mb-3 fw-normal">Setup your Store</h1>
                            <form method="POST">
                                   
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="shopname" name="shopname" placeholder="Shop Name" required/>
                                    <label for="shopname">Shop Name</label>
                                </div>
                                <div class="form-floating mb-4">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="shopdesc" style="height: 100px" required></textarea>
                                    <label for="phone">Shop Description</label>
                                </div>

                                <button type="submit" name="submit" id="submit" class="btn btn-outline-dark w-100 py-2">Proceed</button>
                                
                            </form>
                        </main>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
</div>
</div>
</body>