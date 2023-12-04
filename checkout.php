
<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/navbar.php';
// $file = $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';
// print_r($file);
?>

<body>
  <!-- Checkout Start -->
  <section class="checkout-body">
    <div class="checkout">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="checkout-inner">
              <div class="billing-address">
                <h2>Delivery Information</h2>
                <form>
                  <!-- Fetch user details if logged in -->
                  <!-- For demonstration purposes, using readonly attribute; you may need to handle this on the server -->

                  <div class="mb-3">
                    <label for="address" class="form-label"
                      >Complete Address</label
                    >
                    <textarea
                      class="form-control"
                      id="address"
                      rows="2"
                      placeholder="Enter your address"
                    ></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="addressType" class="form-label"
                      >Address Type (e.g Work, Home)</label
                    >
                    <select
                      class="form-select"
                      id="addressType"
                      placeholder="Enter your address"
                    >
                      <!-- <option value="0" readonly>--SAddress Type--</option> -->
                      <option value="home">Home</option>
                      <option value="work">Work</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="otherDetails" class="form-label"
                      >Other Details</label
                    >
                    <textarea
                      class="form-control"
                      id="otherDetails"
                      rows="2"
                      placeholder="Any additional information"
                    ></textarea>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="checkout-inner">
                  <div class="checkout-summary">
                    <h1>Cart Total</h1>
                    <p>Product Name<span>$99</span></p>
                    <p class="sub-total">Sub Total<span>$99</span></p>
                    <p class="ship-cost">Shipping Cost<span>$1</span></p>
                    <h2>Grand Total<span>$100</span></h2>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 mt-4">
                <div class="checkout-inner">
                  <div class="checkout-payment">
                    <div class="payment-methods">
                      <h1>Payment Methods</h1>
                      <div class="payment-method">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="payment"
                            id="payment-1"
                          />
                          <label class="form-check-label" for="payment-1"
                            >Paypal</label
                          >
                        </div>

                        <div class="payment-method">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="payment"
                            id="payment-2"
                          />
                          <label class="form-check-label" for="payment-2"
                            >Cash on Delivery</label
                          >
</div>
                        </div>
                        
                        <div class="payment-content" id="payment-1-show">
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Cras tincidunt orci ac eros volutpat maximus
                            lacinia quis diam.
                          </p>
                        </div>
                      </div>

                      <!-- Repeat the structure for other payment methods -->
                    </div>
                    <div class="checkout-btn">
                      <button
                        type="submit"
                        name="checkout"
                        class="btn btn-outline-dark w-100 py-2"
                      >
                        Place Order
                      </button>
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

<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/footer.php';?>
</body>                           