<?php
try {
  $bdd = new PDO("mysql:host=localhost;dbname=php_opc", "root", "root");
}
catch(Exeption $e) {
  die("Erreur : " .$e->getMessage());
}

$req = $bdd->prepare("INSERT INTO billets (titre, auteur, contenu, date_creation) VALUES(?, ?, ?, NOW())");
$req->execute(array($_POST["titre"], $_POST["pseudo"], $_POST["article"]));
header("location: index.php");
?>
