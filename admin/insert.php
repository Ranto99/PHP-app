<?php

require '../database.php';

if ($_POST) {
	# code...
	$filename = '';

	if (!empty($_FILES['image'])) {

		# code...
		$targetDirectory = "../../images";
		$image = $_FILES['image']['name'];

		$path = pathinfo($image);
		$filename = $path['filename'];
		$ext = $path['extension'];

		$tmpName = $_FILES['image']['tmp_name'];
		$path_filename_ext = $targetDirectory . $filename . '.' . $ext;
		if (move_uploaded_file($tmpName, $path_filename_ext)) {
			# code...
			$filename = $filename . '.' . $ext;
		}

	}

	$sql = "INSERT INTO produits (name, description, price, category, image) VALUES (?,?,?,?,?)";
	$a = $pdo->prepare($sql)->execute([$_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'], $filename]);

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
            
                <form class="form" role="form" action="" method="post" enctype="mulpipart/form-data">
                            <h1><strong> Ajouter un produits</strong></h1>
                            <br>
                            <div class="form-group">
                                <label for="name">Nom:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom">

                                
                            </div>
                            <div class="form-group">
                            <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">

                            </div>
                            <div class="form-group">
                            <label for="price">Prix:</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix">

                            </div>
                            <div class="form-group">
                            <label for="category">Categories:</label>
                            <select class="form-control" name="category" id="category">

                                <?php   
                                
                                    foreach($pdo->query('SELECT * FROM categories') as $row){
                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                
                                ?>
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Séléctionner un image:</label>
                                <input type="file" id="image" name="image">
                                

                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Ajouter </button>
                                <a class="btn btn-primary" href="index.php">Retour</a>
                            </div>
                    </form>
            </div>
                
        </div>

</body>

</html>