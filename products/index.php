<?php

include_once "../includes/header.php";

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    $sql = "SELECT * FROM products";

    if (!is_null($_GET) && is_array($_GET) && count($_GET) > 0 && isset($_GET['query'])) {
        $sql = "SELECT * FROM products WHERE name LIKE '%" . $_GET['query'] . "%' OR size LIKE '%" . $_GET['query'] . "%'";
    }

    $result = $mysqli->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="container">
    <div class="row m-5">
        <h1>All Products</h1>
        <?php foreach ($products as $product) : ?>
            <div class="col-6">
                <div class="card pb-5 mb-5">
                    <img src="https://images.unsplash.com/photo-1485842536783-f791cdb28f2f?q=80&w=2938&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Product image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo ucwords($product['size']); ?></p>
                        <p class="card-text"><?php echo '£' . $product['price']; ?></p>
                        <?php echo $product['quantity'] <= 0 ? "<p>Out Of Stock</p>" : null; ?>
                        <button class="btn btn-primary" <?php echo $product['quantity'] <= 0 ? "disabled" : null; ?>>Add To Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

include_once "../includes/footer.php";

?>