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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <title></title>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="accueil">Accueil <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="ajout-patient">Nouveau patient</a>
                <a class="nav-item nav-link" href="liste-patients">Liste patients</a>
                <a class="nav-item nav-link" href="profil-patients">Profil patients</a>
                <a class="nav-item nav-link" href="ajout-rendezvous">Nouveau rendez-vous</a>
                <a class="nav-item nav-link" href="liste-rendezvous.php">Liste rendez-vous</a>
            </div>
        </div>
    </nav>

<?php
    

$response = $bdd->query('SELECT `id`, `lastname`, `firstname` FROM `patients` ORDER BY `lastname`');
?>
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
    <input type="submit" class="btn btn-primary" value="Voir les informations" />
</form>
<?php
$requete = $bdd->prepare('SELECT * FROM `patients` WHERE `id` = :id');
$requete->bindValue(':id', htmlspecialchars($_GET['selectPatient']), PDO::PARAM_INT);
$requete->execute();
if ($donnees = $requete->fetch()):
?>
        <p><strong>Nom: </strong><?= htmlspecialchars($donnees['lastname']) ?></p>
        <p><strong>Prénom: </strong><?= htmlspecialchars($donnees['firstname']) ?></p>
        <p><strong>Date de naissance: </strong><?= htmlspecialchars($donnees['birthdate']) ?></p>
        <p><strong>Téléphone: </strong><?= htmlspecialchars($donnees['phone']) ?></p>
        <p><strong>Adresse mail: </strong><?= htmlspecialchars($donnees['mail']) ?></p>
    
        <h1>Rendez-vous:</h1>
    <?php
    $requeteRdv = $bdd->prepare('SELECT patients.id, appointments.dateHour FROM patients INNER JOIN appointments ON patients.id = appointments.idPatients WHERE patients.id=:id');
    $requeteRdv->execute(array('id'=>htmlspecialchars($_GET['selectPatient'])));
    $requeteFetchRdv = $requeteRdv->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    foreach($requeteFetchRdv as $key => $value):?>
        <ul>
            <li><a href="rendezvous.php?id=<?= $value['id'] ?>">Rendez-vous numéro <?= $i.': Le '.$value['dateHour'] ?></a></li>
        </ul>
    <?php
    $i++;
    endforeach;?>

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



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="script.js"></script>
    </body>
</html>