
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';?>
<?php
// echo'hello';
?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="container px-4 px-lg-5">
      <div class="d-flex justify-content-center">
        <div class="card shadow-lg">
          <div class="card-body px-4 py-5 px-md-5">
            <main class="form-signin w-100 m-auto">
              <img
                class="mb-4"
                src="/assets/bootstrap-logo.svg"
                alt=""
                width="72"
                height="57"
              />
              <h1 class="h3 mb-3 fw-normal">Create Account</h1>
              <form>
                <div class="form-floating">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-floating">
                        <input
                          class="form-control"
                          type="text"
                          id="fname"
                          name="fname"
                          placeholder="First Name"
                          required
                        />
                        <label for="fname">First Name</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-floating">
                        <input
                          class="form-control"
                          type="text"
                          id="lname"
                          name="lname"
                          placeholder="Last Name"
                          required
                        />
                        <label for="lname">Last Name</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-floating">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-floating">
                        <input
                          class="form-control"
                          type="email"
                          id="email"
                          name="email"
                          placeholder="yourname@example.com"
                          required
                        />
                        <label for="email">Email</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-floating">
                        <input
                          class="form-control"
                          type="text"
                          id="phone"
                          name="phone"
                          placeholder="09xxxx"
                          required
                        />
                        <label for="phone">Phone Number</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="form-floating">
                  <input
                    class="form-control"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="yourname@example.com"
                    required
                  />
                  <label for="email">Email</label>
                </div> -->
                <div class="form-floating mb-4">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required
                  />
                  <label for="password">Password</label>
                </div>
                <div class="form-floating mb-4">
                  <input
                    type="password"
                    class="form-control"
                    id="confirmPass"
                    name="confirmPass"
                    placeholder="Confirm Password"
                    required
                  />
                  <label for="confirmPass">Confirm Password</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">
                  Sign Up
                </button>
                <p>
                  Already have an account? <a href="login.html">Login here</a>
                </p>
              </form>
            </main>
          </div>
        </div>
      </div>
    </div>
    </body>