<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// $file = __DIR__ .'/database/database.php';
// print_r($file);
// require_once(__DIR__ .'/database/database.php');
?>
<?php 

include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';
?>

<?php


// Fetch all products with their images
$query = "SELECT 
  p.*,
  GROUP_CONCAT(pi.product_image) AS product_images
  FROM 
  products p
  LEFT JOIN 
  productimages pi ON p.product_id = pi.product_id
  GROUP BY 
  p.product_id;";
$stmt = $dbConn->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';

?>
<body>
   <!--navbar-->
   <?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/navbar.php';
   ?>
<!--/navbar-->
    <!-- body Header mura ug slider-->
    <!-- <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5"> -->
        <!-- <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">Shop in style</h1>
          <p class="lead fw-normal text-white-50 mb-0">
            With this shop hompeage template
          </p>
        </div> -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#212529"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1 class="text-white">Online Shopping</h1>
            <p class="lead fw-normal text-white-50 mb-0">An e-commerce website to improve the marketing strategy of various SME businesses in the Municipality of Anahawan.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Shop now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#212529"/></svg>

        <div class="container">
          <div class="carousel-caption">
          <h1 class="text-white">For more information</h1>
            <p class="lead fw-normal text-white-50 mb-0">Don't hesitate to reach out.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Contact us</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#212529"/"/></svg>

        <div class="container">
          <div class="carousel-caption">
          <h1 class="text-white">Buying and Selling</h1>
            <p class="lead fw-normal text-white-50 mb-0">We offer Products you need.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn More</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
      <span class="visually-hidden">Next</span>
    </button>
  </div>
      <!-- </div>
    </header> -->
    <!-- Section-->
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
      <h3>Available Products</h3>
      <br>
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
        <?php foreach ($products as $product) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                         <!-- Display the first product image (if available) -->
                         <?php if (!empty($product['product_images'])) : ?>
                            <?php $imageArray = explode(',', $product['product_images']); ?>
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="height: 200px; overflow: hidden;">
                                <div class="carousel-inner">
                                    <?php foreach ($imageArray as $index => $image) : ?>
                                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="wp-image/<?php echo $image; ?>" class="d-block w-100" alt="Product Image">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        <?php else : ?>
                            <!-- Provide a default image if no product image is available -->
                            <img class="card-img-top" src="wp-image/default_image.jpg" alt="Default Image">
                        <?php endif; ?>

                        <!-- Product details -->
                        <div class="card-body p-4" style="height: 100px; overflow: hidden;">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder"><?php echo $product['product_name']; ?></h5>
                                <!-- Product price -->
                                ₱ <?php echo number_format($product['price'], 2); ?>
                            </div>
                        </div>
                        <!-- Product actions -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="product_details?slug=<?php echo $product['slug']; ?>">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
      </div>
    </section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/footer.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/scripts.php';?>
</html>
