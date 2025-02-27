<?php
require_once('initialize.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Check if valid product ID and category ID
if ($product_id == null || $product_id == false || $category_id == null || $category_id == false) {
    // If IDs are invalid, show an error page
    $error_message = "Invalid product or category ID.";
    header("Location: database_error.php?error_message=" . urlencode($error_message));
    exit();
} else {
    // SQL query to delete the product from the database
    $query = "DELETE FROM products WHERE id = ?";

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "i", $product_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // If deletion was successful, redirect to the product list
            header("Location: index.php?category_id=" . $category_id);
            exit();
        } else {
            // If there was an error deleting the product, redirect to the database error page
            $error_message = "Failed to delete the product: " . mysqli_error($conn);
            header("Location: database_error.php?error_message=" . urlencode($error_message));
            exit();
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If the query preparation fails, show the database error page
        $error_message = "Failed to prepare the delete query: " . mysqli_error($conn);
        header("Location: database_error.php?error_message=" . urlencode($error_message));
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
