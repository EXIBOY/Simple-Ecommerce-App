<?php

include_once "../includes/header.php";

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productSize = $_POST['size'];
    $productImage = $_POST['image'];
    $productId = $_POST['id'];

    $sql = "UPDATE products SET name = '$productName', price = '$productPrice', quantity = '$productQuantity', size = '$productSize' WHERE id = '" . $productId . "'";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: index.php');
    }

    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM products WHERE id = " . $_GET['id'];
    $result = $mysqli->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $product = $products[0];
}

?>

    <div class="container py-5">
        <div class="row">
            <h1 class="text-center">Welcome to the admin dashboard</h1>
            <div class="col-9">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h2>Add New Product</h2>
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product name</label>
                        <input type="text" class="form-control" name="productName" id="productName" required value="<?php echo $product['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Product Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Count" class="form-control" required value="<?php echo $product['quantity']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product price</label>
                        <input type="number" name="price" id="price" placeholder="price" class="form-control" step=".01" required value="<?php echo $product['price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Product Size</label>
                        <select name="size" id="size" class="form-control" required>
                            <option value="small" <?php echo $product['size'] == 'small' ? 'selected' : ''; ?>>Small</option>
                            <option value="medium" <?php echo $product['size'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="large" <?php echo $product['size'] == 'large' ? 'selected' : ''; ?>>Large</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>

<?php

include_once "../includes/footer.php"

?>