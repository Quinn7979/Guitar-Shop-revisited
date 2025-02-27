<?php
// Assuming the necessary files are included (initialize.php, database setup, etc.)
require_once('initialize.php');

// Get the product data from the POST request
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if (
    $category_id == null || $category_id == false ||
    $code == null || $name == null || $price == null || $price == false) {

    $error = "Invalid product data. Check all fields and try again.";
    include('error.php'); // Show error page if data is invalid
} else {
    // Create a new Product object
    $product = new Product();
    
    // Set the properties of the product object
    $product->categoryID = $category_id;
    $product->productCode = $code;
    $product->productName = $name;
    $product->listPrice = $price;

    // Attempt to save the product to the database
    if ($product->save()) {
        // Redirect to the product list page on success
        header("Location: index.php");
        exit();
    } else {
        // Handle error if save fails
        $error_message = "Failed to insert product into the database.";
        include('database_error.php'); // Show database error page
    }
}
?>

