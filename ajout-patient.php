<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'martin76', 'aynwxe3040$');

?>

<form method="get" action="">
  <div class="form-group">
    <label for="lastName">Nom</label>
    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Entrez un nom" />
  </div>
  <div class="form-group">
    <label for="firstName">Prénom</label>
    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Entrez un prénom" />
  </div>
  <div class="form-group">
    <label for="birthDate">Date de naissance</label>
    <input type="date" class="form-control" name="birthDate" id="birthDate" />
  </div>
  <div class="form-group">
    <label for="phone">Téléphone</label>
    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Entrez votre numéro" />
  </div>
  <div class="form-group">
    <label for="mail">Adresse mail</label>
    <input type="email" name="mail" class="form-control" id="mail" />
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$req = $bdd->prepare('INSERT INTO `patients` (`lastName`, `firstName`, `birthDate`, `phone`, `mail`) VALUES (?, ?, ?, ?, ?)');
$req->execute(array($_GET['lastName'], $_GET['firstName'], $_GET['birthDate'], $_GET['phone'], $_GET['mail']));
?>

<a href="liste-patients.php">Voir la liste des patients</a>