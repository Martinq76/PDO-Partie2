<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');

if(isset($_POST)):
if(!$_POST['newLastName'] == ''):
    $requete = $bdd->prepare('UPDATE `patients` SET `lastname`=:newLastName WHERE `id`=:id');
    $requete->bindValue(':newLastName', $_POST['newLastName'], PDO::PARAM_STR);
    $requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
    $requete->execute();
endif;
if(!$_POST['newFirstName'] == ''):
    $requete = $bdd->prepare('UPDATE `patients` SET `firstname`=:newFirstName WHERE `id`=:id');
    $requete->bindValue(':newFirstName', $_POST['newFirstName'], PDO::PARAM_STR);
    $requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
    $requete->execute();
endif;
if(!$_POST['newBirthDate'] == ''):
    $requete = $bdd->prepare('UPDATE `patients` SET `birthdate`=:newBirthDate WHERE `id`=:id');
    $requete->bindValue(':newBirthDate', $_POST['newBirthDate'], PDO::PARAM_STR);
    $requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
    $requete->execute();
endif;
if(!$_POST['newPhone'] == ''):
    $requete = $bdd->prepare('UPDATE `patients` SET `phone`=:newPhone WHERE `id`=:id');
    $requete->bindValue(':newPhone', $_POST['newPhone'], PDO::PARAM_INT);
    $requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
    $requete->execute();
endif;
if(!$_POST['newMail'] == ''):
    $requete = $bdd->prepare('UPDATE `patients` SET `mail`=:newMail WHERE `id`=:id');
    $requete->bindValue(':newMail', $_POST['newMail'], PDO::PARAM_STR);
    $requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
    $requete->execute();
endif;
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <title></title>
    </head>
    <body>

<?php
    

$response = $bdd->query('SELECT `id`, `lastname`, `firstname` FROM `patients` ORDER BY `lastname`');?>

<form method="get" action="profil-patients.php">
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
$requete->bindValue(':id', $_GET['selectPatient'], PDO::PARAM_INT);
$requete->execute();
var_dump($_GET['selectPatient']);
if ($donnees = $requete->fetch()):
?>
    <p><strong>Nom: </strong><?= $donnees['lastname'] ?></p>
    <p><strong>Prénom: </strong><?= $donnees['firstname'] ?></p>
    <p><strong>Date de naissance: </strong><?= $donnees['birthdate'] ?></p>
    <p><strong>Téléphone: </strong><?= $donnees['phone'] ?></p>
    <p><strong>Adresse mail: </strong><?= $donnees['mail'] ?></p>
    
    <h1>Modifier les informations: </h1>
    <form method="post" action="">
        <label for="newLastName">Nom</label>
        <input type="text" class="form-control" name="newLastName" id="newLastName" placeholder="Entrez un nom" /><br />
        <label for="newFirstName">Prénom</label>
        <input type="text" class="form-control" name="newFirstName" id="newFirstName" placeholder="Entrez un prénom" /><br />
        <label for="newBirthDate">Date de naissance</label>
        <input type="date" class="form-control" name="newBirthDate" id="newBirthDate" /><br />
        <label for="newPhone">Téléphone</label>
        <input type="tel" name="newPhone" id="newPhone" class="form-control" placeholder="Entrez votre numéro" /> <br />
        <label for="newMail">Adresse mail</label>
        <input type="email" name="newMail" class="form-control" id="mail" /><br />
        
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
<?php
endif;

?>
    
  
<p><a href="accueil">Revenir à l'accueil</a></p>
        <script src="script.js"></script>
    </body>
</html>