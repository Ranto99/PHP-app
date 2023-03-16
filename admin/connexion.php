<?php
session_start();
if (isset($_POST['valider'])) {
	# code...
	if (!empty($_POST['speudo']) AND !empty($_POST['mdp'])) {
		# code...
		$pseudo_par_defaut = admin;

		$mdp_par_defaut = admin1234;

		$speudo_saisi = htmlspecialchars($_POST['speudo']);
		$mdp_saisi = htmlspecialchars($_POST['mdp']);

		if ($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut) {
			# code...
			$_SESSION['mdp'] = $mdp_saisi;
			header('Localisation: index.php'); 
		}else{
			echo "Votre mot de passe ou speudo est incorrecte";
		}
	}else{
		echo "Veuillez compléter tous les champs";
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../script/jquery-3.6.0.min.js"></script>
    <script src="../script/script.js"></script>
</head>

<body style="background:url(../images/bg.png);">
<h1 class="text-logo"><span class="glyphicon glyphicon-cultery"></span>Big-Boof<span class="glyphicon glyphicon-cultery"></span></h1>

<div class="container admin" style="background:#fff; padding:50px; border-radius:10px;">
    <div class="row">
     
        		<form class="form" role="form" action="index.php" method="post" enctype="mulpipart/form-data">
                    <h1><strong> Espace admin</strong></h1>
                    <br>
                    <div class="form-group">
                        <label for="speudo">Pseudo:</label>
                        <input type="text" class="form-control" id="speudo" name="speudo" placeholder="Votre pseudo">

                        
                    </div>
                    <div class="form-group">
                    <label for="mdp">mot de passe:</label>
                        <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Votre mot de passe">
					 </div>
                   
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Déconnecter </button>
                    </div>
                </form>
        
    </div>

</body>

</html>
 