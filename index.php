<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restauration</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="script/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
</head>
<body style="background-image: url(images/bg.png);">
    
    <div class="container site">

        <h1 class="text-logo"><span class="glyphicon glyphicon-cultery"></span>Big-Boof<span class="glyphicon glyphicon-cultery"></span></h1>
        <div class="row">
            <?php if(isset($_SESSION['user_id'])) { ?>
            <p>
                <a href="logout.php" class="btn btn-success">se déconnecter </a>
            </p>
            <?php } else { ?>
            <p>
                <a href="new.php" class="btn btn-success">Créer un compte </a>
            </p>
            <p>
                <a href="login.php" class="btn btn-primary"> Login</a>
            </p>
            <?php } ?>
        </div>
    </div>
</body>