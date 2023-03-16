<?php
require 'database.php';
// require 'header.php';


if($_POST) {
	$sql = "INSERT INTO utilisateur (email, firstname, password) VALUES (?,?,?)";
    $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
	$rows = $pdo->prepare($sql)->execute([$_POST['email'], $_POST['firstname'], $password]);

	if ($rows>0) {
	echo 'Merci de vous connecter';
	} else {
	echo 'Erreur';
	}
}

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

<body style="background:url(images/b1.png);">
<h1 class="text-logo"><span class="glyphicon glyphicon-cultery"></span>Big-Boof<span class="glyphicon glyphicon-cultery"></span></h1>

    <div class="container admin" style="background:#fff; padding:50px; border-radius:10px;">
        <div class="row">
     
            <form class="form" role="form" action="" method="post">
                    <h1><strong> Inscrivez-vous</strong></h1>
                    <br>
                    <div class="form-group">
                        <label for="firstname">Nom:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre nom">    
                    </div>
                 
                    <div class="form-group">
                    <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Veuillez entre votre email">

                    </div>
                    <div class="form-group">
                    <label for="password">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Veuillez entrer votre mot de passe">

                    </div>
         
                  
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Valider </button>
                       
                    </div>
            </form>
        
         </div>
    </div>

</body>

</html>