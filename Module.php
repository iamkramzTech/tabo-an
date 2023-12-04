<?php

function validatePass($pass, $confirm) 
{
    if ($pass == $confirm) 
    {
        // Check if the password is at least 8 characters long
        if (strlen($pass) >= 8) 
        {
            // Sanitize and validate password
            // For example, you can use password_hash to securely hash the password
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            // Further validation or processing if needed

            return $hashedPassword; // You might want to return the hashed password for storage
        } 
        else 
        {
           $_SESSION['error'] = 'Password must be at least 8 characters long';
        }
    } 
    else 
    {
         $_SESSION['error'] = 'Passwords do not match';
    }
    
    return false; // Indicate failure
}

//login
function verifyPass($pass, $hash)
{
    if(password_verify($pass,$hash))
    {
        //Password Match
        return true;
    }
    else
    {
        //Password does not match
        return false;
    }
}

?>