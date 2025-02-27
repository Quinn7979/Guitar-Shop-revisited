<?php
// Include database connection
require_once('initialize.php');

// Get product ID from the query string (for editing)
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$logger->debug('POST');

if ($product_id == NULL || $product_id == FALSE) {
    $error = "Invalid product ID.";
    include('error.php'); // If product ID is invalid
    exit();
}

// Get product data for the specified product ID
$query = "SELECT productCode, productName, listPrice, categoryID FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $code, $name, $price, $category_id);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Get categories for the select dropdown
$query_categories = "SELECT id, categoryName FROM categories";
$result_categories = mysqli_query($conn, $query_categories);
$categories = [];
if ($result_categories) {
    while ($row = mysqli_fetch_assoc($result_categories)) {
        $categories[] = $row;
    }
    mysqli_free_result($result_categories);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>

<main>
    <h1>Edit Product</h1>
    <form action="edit_product.php" method="post" id="edit_product_form">
        <!-- Hidden input for product ID -->
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

        <label>Category:</label>
        <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id']; ?>" 
                    <?php echo ($category['id'] == $category_id) ? 'selected' : ''; ?>>
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Code:</label>
        <input type="text" name="code" value="<?php echo htmlspecialchars($code); ?>"><br>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>

        <label>List Price:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($price); ?>"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Product"><br>
    </form>
    <p><a href="index.php">View Product List</a></p>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>
