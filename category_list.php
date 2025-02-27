<?php
require_once('database.php');

// Get all categories
$query_categories = "SELECT categoryID, categoryName FROM categories";
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
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        
        <!-- Display the list of categories -->
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?php echo htmlspecialchars($category['categoryName']); ?></td>
            <td>&nbsp;</td> <!-- Empty cell for Edit/Delete buttons -->
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Category</h2>
    
    <!-- Form to add a new category, submitting to add_category.php -->
    <form action="add_category.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required>
        <input type="submit" value="Add Category">
    </form>

    <br>
    <p><a href="index.php">List Products</a></p>

</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>
