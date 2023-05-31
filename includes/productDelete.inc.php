<?php
    include 'func.inc.php';

    if($_SESSION['role_id'] == 1) {

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
           
            $product = new Product($id, $name, $price, $quantity);
            $product->deleteProduct();
         
            header("location:../product.php?msg=Product Deleted Successfully");
            exit();   
            }}
    else {
        header("location:../product.php?msg=Access Denied");
    }