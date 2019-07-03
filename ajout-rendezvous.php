<?php
$infosPatients = $bdd->query('SELECT `id`, `lastname`, `firstname` FROM patients');
$infosPatientsFetch = $infosPatients->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="text-center">Créer un rendez-vous</h1>
<div class="container">
    <form method="post" action="">
        <label for="date">Date</label>
        <input type="text" class="form-control" name="date" id="date" />
    
        <label for="hour">Heure</label>
        <input type="text" name="hour" class="form-control" id="hour" />
        
        <label for="">Patient</label>
        <select name="patientName">
            <option selected disabled></option>
            <?php foreach($infosPatientsFetch as $key=>$value):?>
            <option value="<?= $value['id'] ?>"><?= $value['lastname'].' '.$value['firstname'] ?></option>   
            <?php
            endforeach;?>
        </select>
        
        <input type="submit" value="Valider" />
    </form>
</div>
<?php
        if ($_POST):
            $addAppointment = $bdd->prepare('INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateTime, :idPatient)');
            $addAppointment->execute(array('dateTime'=>$_POST['date'].' '.$_POST['hour'], 'idPatient'=>$_POST['patientName']));
        endif;
?>