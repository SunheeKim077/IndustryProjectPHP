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
    <title>PHP Industry Project</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  bg-primary-subtle p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">PHPIndustryProject</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Report</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="product.php">Product</a>
                    </li>          
                </ul>
            
                <ul class="navbar-nav ms-auto">
                    <?php
                    if(isset($_SESSION['email'])) { ?>
                    
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Hi, <?php echo $_SESSION['email']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="includes/logout.inc.php">Logout</a>
                        </li> <?php
                    } ?>
                </ul>
                
            </div>
        </div>
    </nav>