<?php

    var_dump($_POST);
    var_dump($_GET);

    if (count($_POST)) {
        $productName = $_POST['productName'];
        $productPrice = $_POST['price'];
        $productQuantity = $_POST['quantity'];

        // Connect to database
        $mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
    }
