<?php   
require '../database.php';
if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

if(!empty($_POST['id'])){
    $id = checkInput($_POST['id']);

    $stm = $pdo->prepare("DELETE FROM produits WHERE id = ?");
    $stm->execute(array($id));

    header("Location: index.php");
}

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
    <h1><strong> Supprimer un item</strong></h1>
    <br>
    <div class="row">
     
        <form class="form" role="form" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-warning">Etes vous sur de vouloir supprimer</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">OUi </button>
                <a class="btn btn-default" href="index.php">Non</a>
            </div>
        </form>
        
    </div>

</body>

</html>
