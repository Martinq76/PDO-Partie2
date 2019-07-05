<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');

$requeteDelete = $bdd->prepare('DELETE FROM appointments WHERE appointments.id=:id');
$requeteDelete->execute(array('id'=>(int)$_GET['id']));
header('Location: liste-rendezvous.php');
?>