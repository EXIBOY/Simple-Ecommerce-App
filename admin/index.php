<?php

    include_once "../includes/header.php";

    // Connect to database
    $mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    } else {
        $sql = "SELECT * FROM products";
        $result = $mysqli->query($sql);
        $products = $result->fetch_all(MYSQLI_ASSOC);
    }
?>

    <div class="container py-5">
        <div class="row">
            <h1 class="text-center">Welcome to the admin dashboard</h1>
            <div class="col-6">
                <form action="/admin/createProduct.php" method="POST">
                    <h2>Add New Product</h2>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product name</label>
                        <input type="text" class="form-control" name="productName" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Product Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Count" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product price</label>
                        <input type="number" name="price" id="price" placeholder="price" class="form-control" step=".01" required>
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Product Size</label>
                        <select name="size" id="size" class="form-control" required>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>s
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
            <div class="col-6">
                <h2>Products List</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Quantity Left</td>
                            <td>Size</td>
                            <td>Price</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo ucwords($product['size']); ?></td>
                                <td><?php echo '£' . $product['price']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                </td>
                                <td>
                                    <form action="/admin/deleteProduct.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php

    include_once "../includes/footer.php"

?>