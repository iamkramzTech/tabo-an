<?php 

include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';
?>
<?php
// Assuming you have a PDO connection established

// Retrieve the product_id from the query string
$productSlug = isset($_GET['slug']) ? $_GET['slug'] : null;

// if (!$productSlug) {
//     // Handle the case where no product_id is provided
//     echo "Invalid product ID.";
//     exit;
// }

// Fetch the product details and associated images
$query = "
    SELECT 
        p.*,
        c.name AS category_name,
        GROUP_CONCAT(pi.product_image) AS product_images
    FROM 
        products p
    LEFT JOIN 
        productimages pi ON p.product_id = pi.product_id
    LEFT JOIN
        category c ON p.category_id = c.category_id
    WHERE 
        p.slug = :product_slug
    GROUP BY 
        p.product_id
";
$stmt = $dbConn->prepare($query);
$stmt->bindParam(':product_slug', $productSlug);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$product) {
//     // Handle the case where no product is found for the given ID
//     echo "Product not found.";
//     exit;
// }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';

?>
<!-- Section-->
<body>
<section class="py-5">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <!-- Product Image Carousel -->
           <!-- Display product images using a carousel -->
           <?php if (!empty($product['product_images'])) : ?>
                    <?php $imageArray = explode(',', $product['product_images']); ?>
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px; overflow: hidden;">
                        <div class="carousel-inner">
                            <?php foreach ($imageArray as $index => $image) : ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="wp-image/<?php echo $image; ?>" class="d-block w-100" alt="Product Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php else : ?>
                    <!-- Provide a default image if no product image is available -->
                    <img src="wp-image/default_image.jpg" class="img-fluid" alt="Default Image">
                <?php endif; ?>
          </div>
          <div class="col-lg-6">
           <!-- Display product details -->
           <h1 class="mt-4"><?php echo $product['product_name']; ?></h1>
                <p class="lead"><?php echo $product['short_description']; ?></p>
                <p class="fw-bold">Price: ₱ <?php echo number_format($product['price'], 2); ?></p>
           
           
            <p class="fs--1">Stock: <strong class="text-success">Available</strong></p>
            <p class="fs--1 mb-3">Category: <a class="ms-2" href="#!"><?php echo $product['category_name']; ?></a></p>
            <div class="row">
              <div class="col-auto pe-0">
                <!-- Quantity Input -->
                <div class="input-group input-group-sm" data-quantity="data-quantity">
                  <button class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="minus">-</button>
                  <input class="form-control text-center input-quantity input-spin-none" type="number" min="0" value="0" aria-label="Amount (to the nearest dollar)" style="max-width: 50px" />
                  <button class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="plus">+</button>
                </div>
              </div>
              <div class="col-auto px-2 px-md-3">
                <!-- Add to Cart Button -->
                <a class="btn btn-outline-dark mt-auto" href="#!">
                  <span class="fas fa-cart-plus me-sm-2"></span>
                  <span class="d-none d-sm-inline-block">Add To Cart</span>
                </a>
              </div>
              <div class="col-auto px-0">
                <!-- Wishlist Button -->
                <!-- <a class="btn btn-sm btn-outline-danger border border-300" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wish List">
                  <span class="far fa-heart me-1"></span>282
                </a> -->
              </div>
            </div>
          </div>
        </div>
        <!-- Product Tabs -->
        <div class="row">
          <div class="col-12">
            <div class="mt-4">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active ps-0" id="description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-md-3" id="specifications-tab" data-bs-toggle="tab" href="#tab-specifications" role="tab" aria-controls="tab-specifications" aria-selected="false">Specifications</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-md-3" id="reviews-tab" data-bs-toggle="tab" href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews</a></li>
              </ul>
              <!-- Tab Content -->
              <div class="tab-content" id="myTabContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="tab-description" role="tabpanel" aria-labelledby="description-tab">
                  <div class="mt-3">
                    <p clss="lead"><?php echo $product['short_description']; ?></p></p>
                  </div>
                </div>
                <!-- Specifications Tab -->
                <div class="tab-pane fade" id="tab-specifications" role="tabpanel" aria-labelledby="specifications-tab">
                  <table class="table fs--1 mt-3">
                    <tbody>
                      <tr>
                        <td class="bg-100" style="width: 30%;"></td>
                        <td></td>
                      </tr>
                      <!-- Add more specifications as needed -->
                    </tbody>
                  </table>
                </div>
                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="reviews-tab">
                  <div class="row mt-3">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                      <!-- Reviews go here -->
                      <!-- Example Review -->
                      <div class="mb-1">
                        <span class="fa fa-star text-warning fs--1"></span>
                        <span class="fa fa-star text-warning fs--1"></span>
                        <span class="fa fa-star text-warning fs--1"></span>
                        <span class="fa fa-star text-warning fs--1"></span>
                        <span class="fa fa-star text-warning fs--1"></span>
                        <span class="ms-3 text-1100 fw-semi-bold">Awesome product, great store😍</span>
                      </div>
                      <p class="fs--1 mb-2 text-600">By User1 • October 14, 2023</p>
                      <p class="mb-0">Review content goes here.</p>
                      <hr class="my-4" />
                      <!-- Add more reviews as needed -->
                    </div>
                    <div class="col-lg-6 ps-lg-5">
                      <!-- Review Form -->
                      <form>
                        <h5 class="mb-3">Write your Review</h5>
                        <div class="mb-3">
                          <label class="form-label">Rating: </label>
                          <div class="d-block" data-rater='{"starSize:32","step":0.5}'></div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="formGroupNameInput">Name:</label>
                          <input class="form-control" id="formGroupNameInput" type="text" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="formGroupEmailInput">Email:</label>
                          <input class="form-control" id="formGroupEmailInput" type="email" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="formGrouptextareaInput">Review:</label>
                          <textarea class="form-control" id="formGrouptextareaInput" rows="3"></textarea>
                        </div>
                        <button class="btn btn-outline-dark mt-auto" type="submit">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-5">
    <h3>Related Products</h3>
    <!-- Related products go here -->
  </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/scripts.php';?>
</body>