<?php   
require '../database.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$nameError = $descriptionError = $priceError = $imageError = $categoryError = $name = $description = $price = $image = $category = "";

if (!empty($_POST)){
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $name = checkInput($_FILES['image']['name']);
    $imagePath = '../images/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;


    if(empty($name)){
        $nameError = 'Ce champs ne peut pas etre vide';
        $isSuccess = false;
    }
    if(empty($description)){
        $descriptionError = 'Ce champs ne peut pas etre vide';
        $isSuccess = false;
    }
    if(empty($price)){
        $priceError = 'Ce champs ne peut pas etre vide';
        $isSuccess = false;
    }
    if(empty($category)){
        $categoryError = 'Ce champs ne peut pas etre vide';
        $isSuccess = false;
    }
    if(empty($image)){
        $isImageUpdated = false;
    }
    else{
        $isImageUpdated = true;
        $isUploadSuccess = true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "gif"){
            $imageError = 'les fichiers autorises sont: .pjg .png .gif';
            $isUploadSuccess = false;
        }
        if(file_exists($imagePath)){
            $imageError = 'Ce fichier existe deja';
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 500000){
            $imageError = 'Le fichier de doit pas dépasser le 500KB';
            $isUploadSuccess = false;
        }
        if($isUploadSuccess){
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                $imageError = 'Il y a une erreur lors de upload';
                $isUploadSuccess = false;
            }
        }
    }
    if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)){
      
        if($isImageUpdated){

            $stm = $pdo->prepare("UPDATE produits set name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?");
            $stm->execute(array($name, $description, $price, $category, $image,$id));
        }
        else{
            $stm = $pdo->prepare("UPDATE produits set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
            $stm->execute(array($name, $description, $price, $category,$id));

        }
    
        header("Location: index.php");

    }
    else if($isImageUpdated && !$isUploadSuccess){
    
        $stm = $pdo->prepare("SELECT image FROM produits WHERE id = ?");
        $stm->execute(array($id));
        $produits =  $stm->fetch();
        $image = $produits['image'];

    }
}
else{

    $stm = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
    $stm->execute(array($id));
    $produits =  $stm->fetch();
    $name = $produits['name'];
    $description = $produits['description'];
    $price = $produits['price'];
    $category = $produits['category'];
    $image = $produits['image'];
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
    <div class="row">
        <div class="col-sm-6">

            <h1><strong> Modifier un item</strong></h1>
            <br>
            <form class="form" role="form" action="<?php echo 'update.php?=' . $id; ?>" method="post" enctype="mulpipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>"> <span class="help-inline"><?php echo $nameError; ?></span>
    
                            
                        </div>
                        <div class="form-group">
                        <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>"> <span class="help-inline"><?php echo $descriptionError; ?></span>
    
                        </div>
                        <div class="form-group">
                        <label for="price">Prix:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>"> <span class="help-inline"><?php echo $priceError; ?></span>
    
                        </div>
                        <div class="form-group">
                        <label for="category">Categories:</label>
                        <select class="form-control" name="category" id="category">
    
                            <?php   
                               
                                foreach($pdo->query('SELECT * FROM categories') as $row){
                                        if($row['id']==$category)
                                            echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        else
                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <p><?php echo $image; ?></p>
                            <label for="image">Séléctionner un image:</label>
                            <input type="file" id="image" name="image">
                            <span class="help-inline"><?php echo $imageError; ?></span>
    
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Modifier </button>
                            <a class="btn btn-primary" href="index.php">Retour</a>
                        </div>
                    </form>
            
        </div>
        <div class="col-sm-6">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/' . $image;?>" style="width: 200px">
                    <div class="price">
                        <?php echo number_format((float)$price,3,'.','') . ' Ar'; ?>
                    </div>
                    <div class="caption">
                        <h4><?php echo $name; ?></h4>
                        <p><?php echo $description; ?></p>
                        <a href="#" role="button" class="btn btn-order"><span class="glyphicon glyphicon-shooping-cart"></span> Commander</a>
                    </div>
                </div>
            </div>
     
    </div>

</body>

</html>