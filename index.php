<?php

require './connexion.php';

if(isset($_FILES['file'])){
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    // les extensions acceptées (format images)
    $extensions = ['jpg', 'png', 'jpeg'];
    $maxSize = 400000; // taille max d'une images

    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

        $uniqueName = uniqid('', true);

        //uniqid génère un numéro uniq
        $file = $uniqueName.".".$extension;

        //$file = 5f586bf96dcd38.73540086.jpg
        move_uploaded_file($tmpName, './docs/uploads/'.$name);
        $n='docs/uploads/'.$name;
        $req = $db->prepare('INSERT INTO file (name,size,tmpName,extension) VALUES (?,?,?,?)');
    
        $req->execute([$n ,$size,$tmpName,$extension]);

        echo "Image téléchargée avec succées";
    }
    else{
        echo "erreur lors du téléchargement de fichier";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
       
        
        <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
          <style>
        .container {
            max-width: 1000px
        }
        .custom-select {
            max-width: 150px
        }
    </style>

    </head>
<body>
  
    
    <h3>Ajouter une image</h3>
    <form action="index.php" method="POST" enctype="multipart/form-data">
    
        <label for="file">Images</label>
        <input type="file" name="file">

        <button type="submit">Enregistrer</button>
    </form>
    <a href="LireRecursDir (1).php">Parcourir les dossiers</a>
    <?php 
        $req = $db->query('SELECT name FROM file'); // selectionner les images de la bdd
      
         
  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 6;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  $paginationStart = ($page - 1) * $limit;
  // executer la recette pour recuperer les enregistrment de la bdd
  $files = $db->query("SELECT * FROM file LIMIT $paginationStart, $limit")->fetchAll();

  // recuperer le nombre d'enregistrement
  $sql = $db->query("SELECT count(id) AS id FROM file")->fetchAll();
  $allRecrods = $sql[0]['id'];
  
  // nombre total de page
  $totoalPages = ceil($allRecrods / $limit);
  // affichage suivant et précedent
  $prev = $page - 1;
  $next = $page + 1;
?>

<!---------------------------------------- PARTIE HTML-----------------------------------------------------------------> 

    <div class="container mt-5">
    
        <!-- affichage dans le navigateur de la bdd -->
        
                
                <?php foreach($files as $file):
            
            echo "<img src='".$file['name']."' width='300px' >";
            //echo  "size =" .$file['size'].'extension'. $file['extension'];
                  // echo '<br>';
                   
                endforeach; ?>
               
          
        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Précédent</a>
                </li>
                <?php for($i = 1; $i <= $totoalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">suivant</a>
                </li>
            </ul>
        </nav>
    </div>
    
</body>
</html>        