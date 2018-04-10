<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="contenu/css/style.css">
    <title>Mon Blog</title>
  </head>
  <body>

  <h1>TP Blog</h1>

  <?php
    try {
      $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "");
    }
    catch(Exeption $e) {
      die("Erreur : " .$e->getMessage());
    }
    $req = $bdd->query("SELECT id, auteur, titre, contenu, date_creation FROM billets ORDER BY date_creation DESC LIMIT 0, 5");
    while ($donnees = $req->fetch()) {
  ?>
      <div class="news">
        <h3><?php echo $donnees["titre"]; ?><br /><em><?php echo $donnees["date_creation"]; ?> par <strong><?php echo $donnees["auteur"]; ?></strong></em></h3>
        <p><?php echo $donnees["contenu"]; ?><br /><a href="commentaires.php?billet=<?php echo $donnees["id"]; ?>">Commentaires</a></p>
      </div>
      <hr />
    <?php
    }
    $req->closeCursor();
    ?>

    <form method="post" action="blog_post.php">
      <label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo..." maxlength="20" /><br />
      <label for="titre">Titre : </label><input type="text" name="titre" id="titre" placeholder="Entrez le titre..." maxlength="50" /><br />
      <label for="article">Article : </label><textarea name="article" id="article" placeholder="Entrez votre article..."></textarea><br />
      <input type="submit" value="Envoyer" />
    </form>





  </body>
</html>
