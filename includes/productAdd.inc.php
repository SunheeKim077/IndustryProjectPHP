<?php
    include 'func.inc.php';

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $product = new Product($id, $name, $price, $quantity);
        $product->addProduct();

        $_SESSION['add'] = "<p class='text-success'>Product added successfully</p>";
        header("location:../product.php?msg=addedsuccessfully");
        exit();   
    }
