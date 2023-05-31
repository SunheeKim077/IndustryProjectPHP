<?php
    include "header.php";

    if($_SESSION['role_id'] == 1) {

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    $product = new Product($id, $name, $price, $quantity);
    $product->getParam();

    $name = $_GET['name'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity']; 

?>
    
<div class="container-fluid mt-2" style="min-height:550px">
    <div class="row text-center">
        <div class="col">
            <h2>Update</h2>
        </div>
    </div>
    <div class="row px-5">
        <div class="col">
            <form action="includes/productUpdate.inc.php" method="post">
                <div class="col-md-8 mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $id;?>">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="name" class="form-label">Product Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name;?>">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="price" class="form-label">Price Per Unit:</label>
                    <input type="text" class="form-control" name="price" id="price" value="<?php echo $price;?>">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="quantity" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity;?>">
                </div>
                <input type="hidden" name="id" value=<?php echo $id;?>>
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    
       
    
    </div>

<?php
    include "footer.php";
?>
<?php 
    } else {
        header("location:./product.php?msg=Access Denied");
    }