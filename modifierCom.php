
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Modifier</title>
  </head>
  <body>
    <?php
    try {
      $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "");
    }
    catch(Exeption $e) {
      die("Erreur : " .$e->getMessage());
    }

    $req = $bdd->prepare("SELECT id, auteur, commentaire, date_commentaire FROM commentaires WHERE id = ?");
    $req->execute(array($_GET["com"]));
    $donnees = $req->fetch();
    ?>

    <p><strong><?php echo $donnees["auteur"]; ?></strong> le <?php echo $donnees["date_commentaire"]; ?></p>
    <p><?php echo $donnees["commentaire"]; ?></p>

    <form method="post" action="modifierCom_update.php?com=<?php echo $donnees["id"]; ?>">
      <label for="auteur">Pseudo : </label><input type="text" name="auteur" id="auteur" placeholder="Entrez votre pseudo..." maxlength="20" /><br />
      <label for="commentaire">Commentaire : </label><textarea name="commentaire" id="commentaire" placeholder="Entrez votre commentaire..."></textarea><br />
      <input type="hidden" name="com" value="<?php echo $_GET["com"]; ?>" />
      <input type="submit" value="Modifier" />
    </form>

    <?php
    $req->closeCursor();
     ?>
