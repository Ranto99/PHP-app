<?php   
require '../database.php';

if(!empty($_GET[('id')]))
{
    $id = checkInput($_GET[('id')]);
}


    $stm = $pdo->prepare('SELECT produits.id, produits.name, produits.description, produits.price, produits.image, categories.name AS category
                              FROM produits LEFT JOIN categories ON produits.category = categories.id
                              WHERE produits.id = ?');
    $stm->execute(array($id));
    $produits = $stm->fetch();


    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
        <div class="col-sm-6">
                <h1><strong> Voir un item</strong></h1>
                <br>
                <form action="">
                    <div class="form-group">
                        <label for="">Nom:</label><?php echo ' ' . $produits['name']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Déscription:</label><?php echo ' ' . $produits['description']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Prix:</label><?php echo ' ' . number_format((float)$produits['price'],3,'.','') . ' Ar'; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Category:</label><?php echo ' ' . $produits['category']; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Image:</label><?php echo ' ' . $produits['image']; ?>
                    </div>
                </form>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php">Retour</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4"style = "margin-bottom: 10px;">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/' . $produits['image'];?>" style="width: 200px">
                    <div class="price">
                        <?php echo ' ' . number_format((float)$produits['price'],3,'.','') . ' Ar'; ?>
                    </div>
                    <div class="caption">
                        <h4><?php echo ' ' . $produits['name']; ?></h4>
                        <p><?php echo ' ' . $produits['description']; ?></p>
                        <a href="#" role="button" class="btn btn-order"><span class="glyphicon glyphicon-shooping-cart"></span> Commander</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>