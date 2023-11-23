<!-- <?php

// function login($data)
// {
// 	$errors = array();
 
// 	//validate 
// 	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
// 		$errors[] = "Please enter a valid email";
// 	}

// 	if(strlen(trim($data['password'])) < 4){
// 		$errors[] = "Password must be atleast 4 chars long";
// 	}
 
// 	//check
// 	if(count($errors) == 0){

// 		$arr['email'] = $data['email'];
// 		// $password = hash('sha256', $data['password']);

// 		$query = "select * from users where email = :email limit 1";

// 		$row = database_run($query,$arr);

// 		if(is_array($row)){
// 			$row = $row[0];

// 			if($password === $row->password){
				
// 				$_SESSION['USER'] = $row;
// 				$_SESSION['LOGGED_IN'] = true;
// 			}else{
// 				$errors[] = "wrong email or password";
// 			}

// 		}else{
// 			$errors[] = "wrong email or password";
// 		}
// 	}
// 	return $errors;
// }

// include $_SERVER['DOCUMENT_ROOT'].'sessions/session.php';
// login($userId, $accountType, $isAdmin);

// // Check if the user is logged in
// if (isLoggedIn()) {
//     // User is logged in, get user information
//     $userId = getUserId();

//     if (isAdmin()) {
//         echo "Welcome, Admin $userId!";
//         // Additional admin-specific actions...
//     }
//     // Check if the user is a vendor
//     else if (isVendor()) 
//     {
//         echo "Welcome, Vendor $userId!";
//         // Additional vendor-specific actions...
//     } 
//     else if (isCustomer()) 
//     {
//         // Check if the user is a customer
//         echo "Welcome, Customer $userId!";
//         // Additional customer-specific actions...
//     }
//     else
//     {
//         echo 'You have not login';
//     }
// } 
//  else
// {
//     // User is not logged in, redirect to login page or handle accordingly
//     header('location: my-account');
//     exit();
// }
?> -->