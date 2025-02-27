<?php
require_once('initialize.php');

// Handle new category form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get the category name from the form
    $new_category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING);

    // Check if the category name is not empty
    if (!empty($new_category_name)) {
        // Insert the new category into the database
        $insert_query = "INSERT INTO categories (categoryName) VALUES (?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "s", $new_category_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect to the category list page after adding the category
        header("Location: category_list.php");
        exit();
    } else {
        // Handle error if the category name is empty
        echo "Category name is required!";
    }
}

// Close the database connection
mysqli_close($conn);
?>
