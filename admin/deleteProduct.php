<?php

if (count($_POST)) {
    $productId= $_POST['id'];

    // Connect to database
    $mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    } else {
        $sql = "DELETE FROM products WHERE id=$productId";

        if ($mysqli->query($sql) === TRUE) {
            header('Location: index.php');
        }
    }
}
