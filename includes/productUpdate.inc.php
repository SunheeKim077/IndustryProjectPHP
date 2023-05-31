<?php
    include 'func.inc.php';

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $product = new Product($id, $name, $price, $quantity);
    $product->updateProduct($id, $name, $price, $quantity);

    $_SESSION['update'] = "<p class='text-success'>Product has been updated</p>";
    header("location:../product.php?msg=updatedsuccessfully");
    exit();   
}