<?php
    include "header.php";

    if(isset($_SESSION['id'])){
?>
    
<div class="container-fluid m-2" style="min-height:650px">
    <div class="row text-center">
        <div class="col">
            <h3>Product Page <h3>
            <h5>Hi, <?php echo $_SESSION['email'];?></h5>

    <?php
        if(isset($_SESSION['add'])) {
            echo($_SESSION['add']);
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['update'])) {
            echo($_SESSION['update']);
            unset($_SESSION['update']);
        }
       /* if(isset($_SESSION['delete'])) {
            echo($_SESSION['delete']);
            unset($_SESSION['delete']);
        } */

        if(isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-danger" alert-dismissible fade show role="alert">'
            . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>
        </div>
    </div>

    <div class="row px-5">
        <div class="col-md-10">
            <h4>Add New Product</h4>
            <a href="productAdd.php" class="btn btn-primary" style="width:70px">Add</a>
        
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price Per Unit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $products = new ProductView();
                    echo $products->getProduct();
                ?>
                </tbody>
            </table>
        </div>     
    </div>    
</div>

<?php } 
else { 
    header("location:./home.php");
}
?>

<?php
    include "footer.php";
?>