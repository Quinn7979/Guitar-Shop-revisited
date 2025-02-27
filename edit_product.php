<?php
require_once('initialize.php');

// Get the form data
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);



// Validate inputs
if ($product_id == null || $product_id == false ||
    $category_id == null || $category_id == false ||
    $code == null || $name == null || $price == null || $price == false) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php'); // Show error page if data is invalid
    exit();
}

// Find the existing product in the database
$product = Product::find_by_id($product_id);

if (!$product) {
    $error = "Product not found.";
    include('error.php');
    exit();
}

// Update the product attributes
$product->categoryID = $category_id;
$product->productCode = $code;
$product->productName = $name;
$product->listPrice = $price;

// Save the updated product
if ($product->save()) {
    // Redirect to the product list page on success
    header("Location: index.php");
    exit();
} else {
    $error_message = "Failed to update product in the database.";
    header("Location: database_error.php?error_message=" . urlencode($error_message));
    exit();
}
?>
