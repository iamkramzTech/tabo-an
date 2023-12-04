<?php 
//noe;rofile icon nab
include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';


if(!isset($_SESSION['vendor']) || trim($_SESSION['vendor'])=='')
{
   header("Location:../404");
}
else
{
  //Beginning of the code to fetch the vendor_id based on the user session login.
  /*To fix Integrity constraint error when adding product product.vendor_id 
  *references to vendorshop.vendor_id.
  */
  $vendorQuery = "SELECT users.user_id, vendorshop.vendor_id, vendorshop.shop_name FROM users
  JOIN vendorshop ON users.user_id = vendorshop.user_id
  WHERE users.user_id = :user_id";

  $stmt = $dbConn->prepare($vendorQuery);

  $stmt->bindParam(':user_id',$_SESSION['vendor'],PDO::PARAM_INT);

  $stmt->execute();

  $vendorShopID = $stmt->fetch(PDO::FETCH_ASSOC);
  if($vendorShopID)
  {
    $_SESSION['vendor_shop_id'] = $vendorShopID['vendor_id'];
  }
  else
  {
    $mess = 'Proceed Shop setup';
    echo($mess);
  }
  //End of the code to fetch...Not sure if will work and no bugs😥
}
?>
<?php include('../merchants/includes/header.php')?>
  <body>   
<?php include(__DIR__ . '/../merchants/includes/nav.php');?>

<div class="container-fluid">
  
<?php include(__DIR__ . '/../merchants/includes/sidenav.php');?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="content">
    <?php include(__DIR__ . '/../merchants/includes/header.php')?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
          </div>
          <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button> -->
        </div>
      </div>
      <div class="container mt-5">
    <div class="row">
        <!-- Vendors Box -->
        <div class="col-lg-3">
        <a href="#orders" class="text-decoration-none">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">Processing: 00</p>
                </div>
            </div>
</a>
        </div>

        <!-- Customers Box -->
        <div class="col-lg-3">
        <a href="#products" class="text-decoration-none" onclick="loadContent('products.php')">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">No.: 3</p>
                </div>
            </div>
</a>
        </div>
         <!-- Products Box -->
         <div class="col-lg-3">
         <a href="#customers" class="text-decoration-none">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text">No. 00</p>
                </div>
            </div>
</a>
        </div>
    </div>
</div>
<h2>Reports</h2>
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    </main>
  </div>
</div>

<?php
include(__DIR__ . '/../merchants/includes/footer.php')
?>




  </body>