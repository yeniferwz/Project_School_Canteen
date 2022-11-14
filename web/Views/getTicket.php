<?php
$nom= $_POST["nom"];
$cognom= $_POST["cognom"];
$correu= $_POST["correu"];
$telefon= $_POST["telf"];

echo 'Welcome '. $nom . $cognom .' your email adress is: '. $correu.'. El telèfon és '.$telefon;
?>