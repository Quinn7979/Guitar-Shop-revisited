<?php
require_once('initialize.php');

// Get Categories from the Database
$categories = category::find_all();
$logger->debug('POST');
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Add Product</h1>
        <form action="add_product.php" method="post" id="add_product_form">


            <!-- Category Dropdown -->
            <label>Category:</label>
            <select name="category_id">
    <?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category->id; ?>"
            <?php if (isset($selected_category_id) && $category->id == $selected_category_id) echo 'selected'; ?>>
            <?php echo $category->categoryName; ?>
        </option>
    <?php endforeach; ?>
</select>
<br>

            <!-- Product Code -->
            <label>Code:</label>
            <input type="text" name="code"><br>

            <!-- Product Name -->
            <label>Name:</label>
            <input type="text" name="name"><br>

            <!-- Product List Price -->
            <label>List Price:</label>
            <input type="text" name="price"><br>

            <!-- Submit Button -->
            <label>&nbsp;</label>
            <input type="submit" value="Add Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>
