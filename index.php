<?php
require_once('initialize.php');

// Get category ID
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) ?? 1;

// Get name for selected category
$category = Category::find_by_id($category_id);
$category_name = $category ? $category->categoryName : 'Unknown';

// Get all categories
$categories = Category::find_all();

// Get products for selected category
$products = Product::find_by_category($category_id);
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
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
        <?php foreach ($categories as $category) : ?>
        <li><a href=".?category_id=<?php echo $category->id; ?>">
        <?php echo htmlspecialchars($category->categoryName); ?>
        </a></li>
        <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo htmlspecialchars($category->categoryName); ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>Actions</th> <!-- Add Actions column for Edit and Delete buttons -->
            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
        <td><?php echo htmlspecialchars($product->productCode); ?></td>
        <td><?php echo htmlspecialchars($product->productName); ?></td>
                <td class="right"><?php echo $product->listPrice; ?></td>
                <td>
                    <!-- Delete form -->
                    <form action="delete_product.php" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $product->categoryID; ?>">
                        <input type="submit" value="Delete">
                    </form>
                    <!-- Edit button -->
                    <form action="edit_product_form.php" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_product_form.php">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<?php require_once("footer.php"); ?>
</body>
</html>
