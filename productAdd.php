<?php
    include "header.php";
    if($_SESSION['role_id'] == 1) {  
?>
    
<div class="container-fluid mt-2" style="min-height:550px">
    <div class="row text-center p-2">
        <div class="col">
            <h2>Add New Product</h2>
        </div>
    </div>
    <div class="row px-5">
        <div class="col">
            <form action="includes/productAdd.inc.php" method="post">
                <div class="col-md-8 mb-3">
                    <label for="name" class="form-label">Product Name:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="price" class="form-label">Price Per Unit:</label>
                    <input type="text" class="form-control" name="price" id="price">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="quantity" class="form-control" name="quantity" id="quantity">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?> 

<?php
}
else {
    header('location:./product.php?msg=Access Denied');
}
?>