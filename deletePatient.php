<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');
$requeteDeletePatient = $bdd->prepare('DELETE FROM patients WHERE patients.id=:id');
$requeteDeletePatient->execute(array('id'=>(int)$_GET['id']));
header('Location: liste-patients');
?>