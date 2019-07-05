<form method="post" action="search.php">
    <input type="search" name="searchPatient" placeholder="Nom du patient" />

    <input type="submit" class="btn btn-primary" value="Chercher" />
</form>

<?php
$response = $bdd->query('SELECT id, lastname, firstname FROM patients ORDER BY lastname');
        while($donnees = $response->fetch()):?>
<p><strong>Nom: </strong><?= htmlspecialchars($donnees['lastname']) ?></p>
<p><strong>Prénom: </strong><?= htmlspecialchars($donnees['firstname']) ?><a class="btn btn-primary" href="deletePatient.php?id=<?= htmlspecialchars($donnees['id']) ?>"> Supprimer patient</a></p>


<?php
        endwhile;
        $response->closeCursor();
        ?>
<a href="ajout-patient.php">Créer un nouveau patient</a>
<a href="profil-patients.php">Afficher les informations d'un patient</a>