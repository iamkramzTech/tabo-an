
<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/Module.php';?>


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password) || empty($confirmPass) || empty($userType)) {
        // Handle validation error, redirect to signup page with an error message
        header('Location: signup?error=All fields are required');
        exit();
    }
    else
    {
        
        $hashPassword = validatePass($password,$confirmPass);

        //check if validation was successful
        if($hashPassword!=false)
        {

            //username
            $rawUsername = $fname . $lname;
            $username = strtolower(trim($rawUsername));
            // Generate a unique identifier using a combination of timestamp and random string
            $uniqueNumber = time() . '_' . bin2hex(random_bytes(4)); // Using random_bytes for a random component

            // Combine the username and the unique number
            $uniqueUsername = $username . $uniqueNumber;
            // NOW() for timestamp
            //define sql query
            $query = "INSERT INTO users (first_name, last_name, username, contact_number, email, pass, user_role, created_at) VALUES (:first_name, :last_name, :username, :contact_number, :email, :pass, :user_role, NOW())";

            //Prepare the statement
            $statement = $dbConn->prepare($query);

            //Bind parameter
            $statement->bindParam(':first_name', $fname, PDO::PARAM_STR);
            $statement->bindParam(':last_name', $lname, PDO::PARAM_STR);
            $statement->bindParam(':username', $uniqueUsername, PDO::PARAM_STR);
            $statement->bindParam(':contact_number', $phone, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':pass', $hashPassword, PDO::PARAM_STR);
            $statement->bindParam(':user_role', $userType, PDO::PARAM_INT); // Assuming user_role is an integer

            //execute Query
            $statement->execute();

            //redirect base on user_role
            if($userType==1)
            {
                echo "User selected Vendor";
                //header("Location:merchants/shop-setup");
                exit();
            }
            else if($userType==2)
            {
                echo "User selected Customer";
                // header("Location:index");
                exit();
            }
            else
            {
                $_SESSION['error'] = "Invalid user role!";
                // header("Location:my-account");
            }

        }
        else
        {
            // Handle validation error
            // The error message would be set in the $_SESSION['error'] variable
            header('Location: signup?error=An unknown error occurred');
            exit();
        }
    }

}
else
{
    $_SESSION['error'] ='Invalid request method';
}
?>