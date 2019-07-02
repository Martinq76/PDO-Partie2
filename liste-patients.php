<?php
$response = $bdd->query('SELECT `lastname`, `firstname` FROM `patients`');
        while($donnees = $response->fetch()):?>
<p><strong>Nom: </strong><?= htmlspecialchars($donnees['lastname']) ?></p>
<p><strong>Prénom: </strong><?= htmlspecialchars($donnees['firstname']) ?></p><br />

<?php
        endwhile;
        $response->closeCursor();
        ?>
<a href="ajout-patient.php">Créer un nouveau patient</a>
<a href="profil-patients.php">Afficher les informations d'un patient</a>