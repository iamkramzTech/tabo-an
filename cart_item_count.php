<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php

// Simulate fetching cart information
if (isset($_SESSION['customer'])) 
{
    // Check if the user is logged in
    $userId = $_SESSION['customer'];

    // Fetch the cart item count from the database
    $itemCount = getCartItemCount($userId);

    // Send the count as a JSON response
    echo json_encode(['itemCount' => $itemCount]);
} 
else 
{
    // User is not logged in
    echo json_encode(['itemCount' => 0]);
}
function getCartItemCount($userId) 
{
    include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/database/database.php';
    // Implement your database logic to retrieve the cart item count for the given user
    // Using SELECT query to count the number of items in the user's cart  
   
    // Use prepared statement to prevent SQL injection
    $query = "SELECT COUNT(*) AS count FROM cart WHERE user_id = ?";
    $statement = $dbConn->prepare($query);
    $statement->execute([$userId]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}
?>