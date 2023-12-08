<?php include $_SERVER['DOCUMENT_ROOT'].'/kramzcommerce/sessions/session.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/header.php';?>
<?php

function getCartItems($userId) {
    include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/database/database.php';
    // Fetch cart items for the given user
    $query = "SELECT cart.quantity, products.product_name, products.price FROM cart JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = ?";
    $stmt = $dbConn->prepare($query);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calculateTotal($cartItems) {
    // Calculate the total cost of items in the cart
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>
<?php
/** --------------------------------
 * 
 * “When I fixed this code, only God and I understood what I did. Now only God knows.”
 * 
 *  Total time waste: 45 mins.
 * ----------------------------------
**/


// Check if the user is logged in
if (!isset($_SESSION['customer'])) {
    // Redirect to login page or display a message
    header("Location: my-account");
    exit();
}

// Fetch cart items for the logged-in user
$userId = $_SESSION['customer'];
$cartItems = getCartItems($userId);
?>

<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/navbar.php';?>
<div class="container mt-5">
    <h2>Your Cart</h2>

    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']); ?></td>
                    <td>₱ <?= number_format($item['price'], 2); ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td>₱ <?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <p class="lead">Total: ₱ <?= number_format(calculateTotal($cartItems), 2); ?></p>

        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    <?php endif; ?>
</div>




<?php include $_SERVER['DOCUMENT_ROOT'] . '/kramzcommerce/includes/scripts.php';?>
</html>