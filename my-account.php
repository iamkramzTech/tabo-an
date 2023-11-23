<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';?>

 

<!--wp:login-->

<body>
<!--wp:navbar-->
<?php 
     include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/navbar.php';
   ?>
<!--/wp:navbar-->
<div class="d-flex align-items-start py-4 bg-body-tertiary">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-5 px-md-5">
                        <main class="form-signin">
                            <img class="mb-4" src="/kramzcommerce/assets/logo/account-icon.svg" alt="" width="72" height="57"/>
                            <h1 class="h3 mb-3 fw-normal">Login</h1>
                            <form>
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" id="signupEmail" name="email" placeholder="yourname@example.com" required/>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Password" required/>
                                    <label for="password">Password</label>
                                </div>
                                <button type="submit" class="btn btn-outline-dark w-100 py-2">Login</button>
                            </form>
                        </main>
                    </div>
                </div>
            </div>
      
    
<!--/wp:login-->

<!--wp:register-->

        <div class="col-lg-6 col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-5 px-md-5">
                        <main class="form-signin">
                            <img class="mb-4" src="/kramzcommerce/assets/logo/account-icon.svg" alt="" width="72" height="57"/>
                            <h1 class="h3 mb-3 fw-normal">Create Account</h1>
                            <form>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" required/>
                                            <label for="fname">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" required/>
                                            <label for="lname">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="yourname@example.com" required/>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="09xxxx" required/>
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Confirm Password" required/>
                                    <label for="confirmPass">Confirm Password</label>
                                </div>

                                <div class="form-floating mb-4">
                                <div class="btn-group" role="group" aria-label="Vertical radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="vbtn-customer" autocomplete="off">
                                 <label class="btn btn-outline-dark" for="vbtn-customer">I am Customer</label>
                                <input type="radio" class="btn-check" name="btnradio" id="vbtn-vendor" autocomplete="off">
                                <label class="btn btn-outline-dark" for="vbtn-vendor">I am Vendor</label>
                                </div>
                                </div>

                                <button type="submit" class="btn btn-outline-dark w-100 py-2">Sign Up</button>
                                
                            </form>
                        </main>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

    </body>
<!--/wp:register-->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/footer.php'; ?>