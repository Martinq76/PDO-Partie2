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

<form method="post" action="">
    <input type="search" name="searchPatient" placeholder="Nom du patient" />

    <input type="submit" class="btn btn-primary" value="Chercher" />
</form>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');

$requeteSearch = $bdd->prepare('SELECT patients.id, patients.lastname, patients.firstname FROM patients WHERE patients.lastname LIKE :search OR patients.firstname LIKE :search');
$requeteSearch->bindValue('search', '%'.$_POST['searchPatient'].'%', PDO::PARAM_STR);
$requeteSearch->execute();
$requeteSearchFetch = $requeteSearch->fetchAll(PDO::FETCH_ASSOC);

foreach($requeteSearchFetch as $key=>$value):?>
    <ul>
        <li><a href="profil-patients.php?id=<?= $value['id'] ?>">Patient n°<?= $value['id'] ?>: <?= $value['lastname'].' '.$value['firstname'] ?></a></li>
    </ul>
<?php
endforeach;
?>

<a href="liste-patients">Retour</a>

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