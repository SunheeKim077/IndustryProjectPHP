<?php
    include 'includes/func.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center mt-5" style="min-height: 400px;">
   <!-- d-flex justify-content-center align-items-center" style="min-height: 550px -->
        <?php
            if(isset($_SESSION['register'])) {
                echo($_SESSION['register']);
                unset($_SESSION['register']);
            }
        ?>
        <form action="includes/login.inc.php" method="post" class="border shadow p-3    rounded" style="width:400px">
            <h2 class="text-center">Login</h2>
            <?php
                if(isset($_GET["error"])) { ?>
                    <div class="alert alert-danger" role="alert">
                    
                        <?=$_GET["error"]?>
                    </div> <?php
                }              
            ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required="true" >
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" name="pwd" id="pwd" required="true">
            </div>
           
            <button type="submit" name="submit" class="btn btn-primary mt-2">Login</button>
            <div class="mt-5">
                <p>Don't have an account?</p>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        </form>
    </div>
    
       
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>