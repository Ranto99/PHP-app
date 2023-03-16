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
    
    <div class="container site">

        <h1 class="text-logo"><span class="glyphicon glyphicon-cultery"></span>Big-Boof<span class="glyphicon glyphicon-cultery"></span></h1>

            <p>
                <a href="../logout.php" class="btn btn-success">se déconnecter </a>
            </p>

        <?php

        // session_start();
        require '../database.php';

            echo ' <nav class="navbar fixed navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mt-sm-0">';
         
            $stm = $pdo->query('SELECT * FROM categories');
            $categories = $stm->fetchAll();
            foreach($categories as $category)
            {
                if($category['id'] == '1')
                    echo '<li role="presentation" class="nav-item active">
                    <a class="nav-link" href="#' . $category['id'] . '">' . $category['name'] . ' <span class="sr-only">(current)</span></a>
                    </li>';
                else
                echo '<li role="presentation">
                <a class="nav-link" href="#' . $category['id'] . '">' . $category['name'] . ' <span class="sr-only">(current)</span></a>
                </li>';
            }
            echo '</ul>
               
            </div>
            
          
            </nav>';
            echo '<div class="tag-content">';
            foreach($categories as $category)
            {
                if($category['id'] == '1')
                echo '<div class="tag-pane active" id=" '. $category['id'] .' ">';
                else
                echo '<div class="tag-pane" id="'.$category['id'] .'">';
                echo '<div class="row">';

             $stm = $pdo->prepare('SELECT * FROM produits WHERE produits.category = ?');
             $stm->execute(array($category['id']));

             while($produits = $stm->fetch()){
                echo '<div class="col-sm-6 col-md-4" style = "margin-bottom: 10px;">
                <div class="img-thumbnail">
                    <img src="../images/' . $produits['image'] . '" style="width: 200px;">
                    
                    <div class="price">' . number_format((float)$produits['price'],3,'.','') . ' Ar
                    </div>xa
                    <div class="caption">
                    <h4>' . $produits['name'] . '</h4>
                    <p>' . $produits['description'] . '</p>
                    <a href="#" role="button" class="btn btn-order"><span class="glyphicon glyphicon-shooping-cart"></span> Commander</a>
                    </div>
                </div>
                </div>';
             }
             echo '</div>
                    </div>
                   ';
             }
             echo '</div>';
           
        ?>
    </div>

</body>
</html>