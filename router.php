<?php

//sample routing 

$uri = isset($_GET['uri']) ? $_GET['uri'] : '';
$uri = rtrim($uri, '/'); // Remove trailing slash
$parts = explode('/', $uri);

// Determine which page to load
$page = empty($parts[0]) ? 'home' : $parts[0];

if ($page === 'admin' && isset($parts[1]) && $parts[1] === 'dashboard') {
    // Route to the admin dashboard page
    $template = 'admin/dashboard.php';
} elseif ($page === 'admin' && isset($parts[1]) && $parts[1] === 'login') {
    // Route to the admin login page (if you have one)
    $template = 'templates/admin_login.php';
} elseif ($page === 'search') {
    // Handle search
    $query = $_GET['q'];
    // Implement your search logic and display results
} elseif (file_exists("templates/$page.php")) {
    $template = "templates/$page.php";
} else {
    // Handle 404 error
    $template="templates/404.php";
}

include $template;
?>