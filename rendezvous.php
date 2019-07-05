<?php
$patientId = $_GET['id'];
if(COUNT($_POST) > 0):
    $newDateHour = $_POST['newDate'] . ' ' . $_POST['newHour'];
    $bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');
    $requete = $bdd->prepare('UPDATE `appointments` SET `dateHour`=:newDateHour WHERE `id`=:id');
    $requete->bindValue(':newDateHour', $newDateHour, PDO::PARAM_STR);
    $requete->bindValue(':id', $patientId, PDO::PARAM_INT);
    if($requete->execute()){
        header('Location: rendezvous.php?id='.$patientId);
    }
endif;
?> 
    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <title>PDO Partie2</title>
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
        
        <h1>Infos rendez-vous patient: </h1>
        <?php
        if($_GET['page'] == 'accueil'):?>
        <h1>Bienvenue !</h1><?php
    elseif ($_GET['page'] == 'ajout-patient'):
        include 'ajout-patient.php';
    elseif($_GET['page'] == 'liste-patients'):
        include 'liste-patients.php';
    elseif($_GET['page'] == 'profil-patients'):
        include 'profil-patients.php';
    elseif($_GET['page'] == 'ajout-rendezvous'):
        include 'ajout-rendezvous.php';
    endif;
        
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');

$requeteInfosPrepare = $bdd->prepare('SELECT appointments.id, dateHour,  patients.lastname, patients.firstname FROM appointments INNER JOIN patients ON appointments.idPatients=patients.id WHERE appointments.id=:id');
$requeteInfosPrepare->execute(array('id'=> htmlspecialchars($_GET['id'])));
$requeteFetch = $requeteInfosPrepare->fetchAll(PDO::FETCH_ASSOC);
 foreach ($requeteFetch as $key => $value):
        $id =(int)$value['id'];?>
        <ul>
            <li>Nom du patient: <b><?= $value['lastname'].' '.$value['firstname'] ?></b></li>
            <li>Date et heure du rendez-vous: <b><?= $value['dateHour'] ?></b></li>
        </ul>
    <?php
 endforeach;?>
      
        <h1>Modifier infos rendez-vous:</h1>
        
        <form method="post" action="">
            <label for="newDate">Nouvelle Date</label>
            <input type="text" class="form-control" name="newDate" id="newDate" />
            
            <label for="newHour">Nouvelle heure</label>
            <input type="text" class="form-control" name="newHour" id="newHour" />
            
            <input type="submit" class="btn-primary btn" value="Valider la modifiation" />
        </form>
  
    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </body>
</html>