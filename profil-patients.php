<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', base64_decode('YXlud3hlMzA0MCQ='));

$response = $bdd->query('SELECT `id`, `lastname`, `firstname` FROM `patients` ORDER BY `lastname`');?>

<form method="get" action="">
    <label for="selectPatient">Sélectionner un patient</label>
    <select name="selectPatient">
        <option value="" disabled selected>Liste patients</option>

<?php

while($donnees = $response->fetch()):?>
    
        <option value="<?= htmlspecialchars($donnees['id']) ?>"><?= htmlspecialchars($donnees['lastname']).' '.htmlspecialchars($donnees['firstname']) ?></option>
    
<?php
endwhile;
$response->closeCursor();?>

    </select>
    <input type="submit" value="Voir les informations" />
</form>
<?php
$requete = $bdd->prepare('SELECT * FROM `patients` WHERE `id` = :id');

$requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_STR);

$requete->execute();

if ($donnees = $requete->fetch()):?>
    <p><strong>Nom: </strong><?= $donnees['lastname'] ?></p>
    <p><strong>Prénom: </strong><?= $donnees['firstname'] ?></p>
    <p><strong>Date de naissance: </strong><?= $donnees['birthdate'] ?></p>
    <p><strong>Téléphone: </strong><?= $donnees['phone'] ?></p>
    <p><strong>Adresse mail: </strong><?= $donnees['mail'] ?></p>
    <p><a href="">Modifier les données</a></p>
<?php
endif;
?>

<p><a href="index.php">Revenir à l'accueil</a></p>