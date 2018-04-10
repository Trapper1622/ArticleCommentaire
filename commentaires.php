<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="contenu/css/style.css">
    <title>Commentaires</title>
  </head>
  <body>
    <?php
    try {
      $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "");
    }
    catch(Exeption $e) {
      die("Erreur : " .$e->getMessage());
    }

    $req = $bdd->prepare("SELECT id, auteur, titre, contenu, date_creation FROM billets WHERE id = ?");
    $req->execute(array($_GET["billet"]));
    $donnees = $req->fetch();
    ?>

    <div class="news">
      <h3><?php echo $donnees["titre"]; ?><br /> le <?php echo $donnees["date_creation"]; ?> par <?php echo $donnees["auteur"]; ?></h3>
      <p><?php echo $donnees["contenu"]; ?></p>
    </div>

    <form method="post" action="commentaire_post.php?billet=<?php echo $donnees["id"]; ?>">
      <label for="auteur">Pseudo : </label><input type="text" name="auteur" id="auteur" placeholder="Entrez votre pseudo..." maxlength="20" /><br />
      <label for="commentaire">Commentaire : </label><textarea name="commentaire" id="commentaire" placeholder="Entrez votre commentaire..."></textarea><br />
      <input type="hidden" name="billet" value="<?php echo $_GET["billet"]; ?>" />
      <input type="submit" value="Envoyer" />
    </form>
    <br />
    <a href="index.php">Retour</a>

    <?php
    $req->closeCursor();

    $req = $bdd->prepare("SELECT id, id_article, auteur, commentaire, date_commentaire FROM commentaires WHERE id_article = ? ORDER BY date_commentaire");
    $req->execute(array($_GET["billet"]));

    while ($donnees = $req->fetch()) {
    ?>
      <p><strong><?php echo $donnees["auteur"]; ?></strong> le <?php echo $donnees["date_commentaire"]; ?> (<a href="modifierCom.php?com=<?php echo $donnees["id"]; ?>">modifier</a>)</p>
      <p><?php echo $donnees["commentaire"]; ?></p>
    <?php
    }
    $req->closeCursor();
    ?>
  </body>
</html>
