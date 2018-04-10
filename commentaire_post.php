<?php
try {
  $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "");
}
catch(Exeption $e) {
  die("Erreur : " .$e->getMessage());
}

$req = $bdd->prepare("INSERT INTO commentaires (auteur, commentaire, id_article, date_commentaire) VALUES(?, ?, ?, NOW())");
$req->execute(array($_POST["auteur"], $_POST["commentaire"], $_POST["billet"]));
header("location: commentaires.php?billet=" .$_POST["billet"]);
 ?>
