<?php 
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';?>

<?php

if(isset($_POST['login']))
{
  $userId = null;
  $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
  $pass = trim($_POST['password']);

  if(!empty($email) && !empty($pass))
  {
    $qtxt = "SELECT * FROM administrator WHERE email=:email LIMIT 1";

    //Prepare the statement
    $statement = $dbConn->prepare($qtxt);

    //Bind parameter
    $statement->bindparam('email', $email,PDO::PARAM_STR);

    //execute Query
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

  if($user)
  {
    if(password_verify($pass,$user['pass']))
    {
     // Login successful
     $userId = $user['id'];
     $role = $user['user_role'];

     //redirect(userId,role)
     redirect($userId,$role);
    }
     else
     $_SESSION['error']="Incorrect Password";
    //  header('location: index');
    //  exit();
  }
  else
  {
    $_SESSION['error']="Account not found.";
    // header('location: index');
    // exit();
  }
//  $hash = password_hash('variable_password',PASSWORD_DEFAULT);
// print_r($hash);
// $decode = password_verify($pass,$hash);
  } 
  else
  {
    $_SESSION['error']='All fields are mandatory';
  }
 }


?>


<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index">TABO-AN</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
</nav>
<div class="d-flex align-items-center py-4 bg-body-tertiary">
    <!-- <div class="container px-4 px-lg-5">
      <div class="login-container"> -->
    <div class="container px-4 px-lg-5">
      <div class="d-flex justify-content-center">
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
            <main class="form-signin w-100 m-auto">
              <img
                class="mb-4"
                src="/kramzcommerce/assets/logo/account-icon.svg"
                alt=""
                width="72"
                height="57"
              />
              <h3 class="h3 mb-3 fw-normal">Admin Login</h3>
              <form method="POST">

                <div class="form-floating mb-4">
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
                <button type="submit" name="login" class="btn btn-outline-dark w-100 py-2">
                  Login
                </button>
                
              </form>
            </main>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    </body>
  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/footer.php'; ?>
    <!-- </div> -->

    <!-- </div> -->