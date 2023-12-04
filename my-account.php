<?php 
include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/Module.php';
?>

<?php
if(isset($_SESSION['vendor']))
{
  header('Location:merchants/dashboard');
}
?>

<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST['login'])) 
    {
        // Login form submitted
        $loginEmail = filter_var(trim($_POST['loginEmail']),FILTER_VALIDATE_EMAIL);
        $loginPassword = $_POST['loginPassword'];

        if(!empty($loginEmail) && !empty($loginPassword))
        {
            $query = "SELECT * FROM users WHERE email=:email LIMIT 1";
            //Prepare the statement
            $statement = $dbConn->prepare($query);

            //Bind parameter
            $statement->bindparam(':email', $loginEmail,PDO::PARAM_STR);

            //execute Query
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if($user)
            {
                $auth = verifyPass($loginPassword,$user['pass']);
                if($auth===false)
                {
                    $_SESSION['errors'] = ['Incorrect email or password. Please try again.'];
                }
                else
                {
                    // Login successful
                    $id = $user['user_id'];
                    $role = $user['user_role'];
                    userLogin($id,$role);
                }
            }
            else
            {
                $_SESSION['errors']="Account not found.";
            }
        }

        // // Example authentication using a simple check (replace this with your actual authentication logic)
        // $authenticated = true; // Replace with your authentication logic

        // if ($authenticated) 
        // {
        //     // Redirect to the desired page after successful login
        //     header("Location: dashboard.php");
        //     exit();
        // } 
        // else 
        // {
        //     $_SESSION['errors'] = ['Invalid email or password. Please try again.'];
        // }
    }
     else if (isset($_POST['signup'])) 
     {
        // Registration form submitted
        // ... (your existing registration logic)
         // Retrieve form data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPass'];

        // Check which radio button is selected
        $userType = isset($_POST['btnradio']) ? ($_POST['btnradio'] == 'vbtn-customer' ? 2 : 1) : '';
        // Perform basic validation
        if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password) || empty($confirmPass) || empty($userType)) 
        {
            // Handle validation error, set errors in session
            $_SESSION['errors'] = ['All fields are required'];
        } 
        else 
        {

         // Check if the email already exists in the database
            $existingEmailQuery = "SELECT COUNT(*) FROM users WHERE email = :email";
            $existingEmailStatement = $dbConn->prepare($existingEmailQuery);
            $existingEmailStatement->bindParam(':email', $email, PDO::PARAM_STR);
            $existingEmailStatement->execute();
            $existingEmailCount = $existingEmailStatement->fetchColumn();

            if($existingEmailCount > 0)
            {
                 // Handle validation error, set errors in session
            $_SESSION['errors'] = ['Email address already exist.'];
            }

            else
            {
                // Validate password and set errors in session
            $hashPassword = validatePass($password, $confirmPass);
            if ($hashPassword === false) 
            {
                $_SESSION['errors'] = [$_SESSION['error']];
            } 
            else 
            {
                // Generate a unique identifier using a combination of timestamp and random string
                $uniqueNumber = time() . '_' . bin2hex(random_bytes(4)); // Using random_bytes for a random component

                // Combine the username and the unique number
                $uniqueUsername = strtolower(trim($fname . $lname)) . $uniqueNumber;

                // Define SQL query
                $query = "INSERT INTO users (first_name, last_name, username, contact_number, email, pass, user_role, created_at) VALUES (:first_name, :last_name, :username, :contact_number, :email, :pass, :user_role, NOW())";

                // Prepare the statement
                $statement = $dbConn->prepare($query);

                // Bind parameters
                $statement->bindParam(':first_name', $fname, PDO::PARAM_STR);
                $statement->bindParam(':last_name', $lname, PDO::PARAM_STR);
                $statement->bindParam(':username', $uniqueUsername, PDO::PARAM_STR);
                $statement->bindParam(':contact_number', $phone, PDO::PARAM_STR);
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':pass', $hashPassword, PDO::PARAM_STR);
                $statement->bindParam(':user_role', $userType, PDO::PARAM_INT); // Assuming user_role is an integer

                // Execute Query
                $statement->execute();

                 // Retrieve the last inserted user ID
                $userID = $dbConn->lastInsertId();


                // Redirect based on user_role
                redirect($userID,$userType);

                // // Redirect based on user_role
                // if ($userType == 1) 
                // {
                //     // User selected Vendor
                //     header("Location: merchants/shop-setup?userID=$userID");
                //     exit();
                // } 
                // else if ($userType == 2) 
                // {
                //     // User selected Customer
                //     header("Location: index");
                //     exit();
                // } 
                // else 
                // {
                //     $_SESSION['errors'] = ["Invalid user role!"];
                // }
            }
            }
            
        }
    
    }
}

// Display errors, if any
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']); // Clear errors from session
?>

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
             <!-- Display errors, if any -->
     <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
    <?php endif; ?>
        <div class="col-lg-6 col-md-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-5 px-md-5">
                    
                        <main class="form-signin">
                            <img class="mb-4" src="/kramzcommerce/assets/logo/account-icon.svg" alt="" width="72" height="57"/>
                            <h1 class="h3 mb-3 fw-normal">Login</h1>
                            <form method="POST" action="">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" id="loginEmail" name="loginEmail" placeholder="yourname@example.com" required/>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password" required/>
                                    <label for="password">Password</label>
                                </div>
                                <button type="submit" name="login" id="login" class="btn btn-outline-dark w-100 py-2">Login</button>
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
                            <form method="POST" action="">
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
                                <input type="radio" class="btn-check" name="btnradio" id="vbtn-customer" value="vbtn-customer" autocomplete="off">
                                 <label class="btn btn-outline-dark" for="vbtn-customer">I am Customer</label>
                                <input type="radio" class="btn-check" name="btnradio" id="vbtn-vendor" value="vbtn-vendor" autocomplete="off">
                                <label class="btn btn-outline-dark" for="vbtn-vendor">I am Vendor</label>
                                </div>
                                </div>

                                <button type="submit" name="signup" id="signup" class="btn btn-outline-dark w-100 py-2">Sign Up</button>
                                
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