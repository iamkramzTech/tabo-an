<?php 
include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';
?>

<?php

// Simulate fetching cart information
$cartItemCount = count($_SESSION['cart'] ?? []);

// Check if the user is logged in
if (!isset($_SESSION['customer'])) 
{
    $response = ['message' => 'You must be logged in to add items to the cart.', 'error' => true];
    echo json_encode($response);
    exit();
}

// If the user is logged in, proceed to add the product to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) 
{
    $productId = $_POST['productId'];
    $quantity = 1;
    $userId = $_SESSION['customer'];

     // Add the product to the cart in the database
     addToCart($userId, $productId, $quantity);
     $response = ['message' => 'Product added to the cart successfully', 'error' => false];
     echo json_encode($response);
     exit();
}

function addToCart($userId, $productId, $quantity)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/database/database.php';
    // Check if the product is already in the cart
    $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $statement = $dbConn->prepare($query);
    $statement->execute([$userId, $productId]);
    $cartItem = $statement->fetch(PDO::FETCH_ASSOC);

    if($cartItem)
    {
        // Product is already in the cart, update quantity
        $newQuantity = $cartItem['quantity'] + $quantity;
        $stmt = $dbConn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$newQuantity, $userId, $productId]);
    }
    else
    {
          // Product is not in the cart, add it
          $stmt = $dbConn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
          $stmt->execute([$userId, $productId, $quantity]);
    }
}
?>