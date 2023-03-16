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
        <h1><strong>Listes des items</strong><a href="insert.php" class="btn btn-success btn-lg"> <span class="glyphicon glyphicon-plus"></span>     Ajouter</a></h1>
                                <a href="deconnexion.php" class="btn btn-d btn-lg"> <span class="glyphicon glyphicon-plus"></span>     Déconnecter</a></h1>

        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Déscription</th>
      <th scope="col">Prix</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
    
    require '../database.php';


    $stm = $pdo->query('SELECT produits.id, produits.name, produits.description, produits.price, categories.name AS category
                            FROM produits LEFT JOIN categories ON produits.category = categories.id
                            ORDER by produits.id DESC');
    while($produits = $stm->fetch())
    {
      echo '<tr>';
      echo  '<th scope="row">' . $produits['name'] . '</th>';
      echo '<td>' . $produits['description'] . '</td>';
      echo '<td>' . number_format((float)$produits['price'],3,'.','') . '</td>';
      echo '<td>' . $produits['category'] . '</td>';
      echo '<td width=300>';
      echo '<a class="btn btn-dark" href="view.php?id=' . $produits['id'] . '"> <span class="glyphicon glyphicon-eyes-open"></span> Voir</a>';
      echo ' ';
      echo '<a class="btn btn-primary" href="update.php?id=' . $produits['id'] . '"> <span class="glyphicon glyphicon-pencil" ></span> Modifier</a>';
      echo ' ';
      echo '<a class="btn btn-danger" href="delete.php?id=' . $produits['id'] . '"> <span class="glyphicon glyphicon-remove" ></span> Supprimer</a>';
      echo ' ';
      echo '</td>';
      echo '</tr>';
    }

  ?>

  
  </tbody>
</table>
        
    
    </div>
</div>
</body>

</html>
