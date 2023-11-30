<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/database/database.php');

session_start();

/*
*NOTE: user_role
* 0 = admin
* 1 = vendor
* 2 = customer
*/
//redirect(userid,role)
function redirect($userId,$role) {

 switch($role) {
    case 0:
        $_SESSION['admin'] = $userId;
        header('Location:admin/dashboard');
        break;
    case 1:
        //vendor
        $_SESSION['vendor'] = $userId;
        header("Location:merchants/shop-setup?userID=$userId");
        break;

    case 2:
        //customer
        $_SESSION['customer'] = $userId;
        header('Location:user-profile');
        break;
    default:
        //account type not found
        $_SESSION['errors'] = ["Invalid user role!"];
        header('Location:my-account');
        exit();
        
 }
}

// Function to log out a user
function logout() {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();
    header('location:index');
}

?>
