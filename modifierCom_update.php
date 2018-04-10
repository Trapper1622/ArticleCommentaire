<?php
try {
  $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "");
}
catch(Exeption $e) {
  die("Erreur : " .$e->getMessage());
}


$req = $bdd->prepare("UPDATE commentaires SET auteur = ?, commentaire = ?, date_commentaire = NOW() WHERE id = ?");
$req->execute(array($_POST["auteur"], $_POST["commentaire"], $_GET["com"]));

header("location: index.php");




 ?>
