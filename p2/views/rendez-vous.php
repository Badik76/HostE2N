<?php
include '../models/database.php';
include '../models/patients.php';
include '../models/appointments.php';
include '../controllers/ctlr-rendez-vous.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>E2N - L'Hosto du Pauvre !</title>
        <link rel="shortcut icon" href="../assets/img/doigt.png"/>
        <meta name="author" content="Badik76" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
        <link href="https://fonts.googleapis.com/css?family=Thasadith" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../assets/import/Materialize/css/materialize.min.css"  media="screen" />
        <!-- Import personnal stylesheet -->
        <link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
        <!--Let browser know website is optimized for mobile-->
    </head>
    <body>
        <div class="container">
            <div class="card-panel center-align wrapper-align">
                <!-- si nous ne trouvez pas de rdv on affiche un message d'erreur -->
                <?php if ($appointmentIsFind) { ?>
                    <h2>RENDEZ-VOUS</h2>
                <?php } else { ?>
                    <h2>DESOLE ...</h2>
                <?php } ?>

                <?php if ($modifySuccess) { ?>
                    <h2><?= 'Rendez-vous modifié !' ?></h2>
                <?php } ?>

                <!-- Mise en place d'une boucle pour faire apparaitre les erreurs liées lors du choix du rdv : date, heure, patient -->  
                <?php foreach ($appointmentChoiceError AS $error) { ?>
                    <h2 class="error"><?= $error ?></h2>
                <?php } ?>  
            </div>

            <div class="card-panel">




                <!-- On affiche un message si les modifications ont bien été prises en compte via un if -->
                <?php if ($appointmentIsFind) { ?>
                    <form id="modifyAppointment" action="rendezvous.php?idAppointment=<?= $appointments->id ?>" method="POST">
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="date" name="date" type="text" value="<?= $appointments->date ?>"  class="datepicker" /> 
                                <label for="date">Date</label>
                                <p class="error"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="hour" name="hour" type="text" value="<?= $appointments->hour ?>"  class="timepicker" /> 
                                <label for="heure">Heure</label>
                                <p class="error"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <select id="idPatient" name="idPatient">
                                    <option>Choix du patient</option>
                                    <?php foreach ($listPatients AS $patient) { ?>
                                        <option value="<?= $patient->id ?>" <?= $patient->id == $appointments->idPatients ? 'selected' : '' ?>><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                                    <?php } ?>
                                </select>
                                <label for="idPatient">Nom du patient</label>
                                <p class="error"><?= isset($formError['idPatient']) ? $formError['idPatient'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 center-align">
                                <input name="modifyButton" type="submit" class="waves-effect waves-light btn teal" value="Enregistrer Modification(s)"/>
                                <p class="error"><?= isset($formError['update']) ? $formError['update'] : '' ?></p>
                                <a href="liste-rdv.php" class="waves-effect waves-light btn"><i class="material-icons left">list</i>RETOUR LISTE RDV</a>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <p>Ce rdv n'a pas été trouvé.</p>
                <?php } ?>
            </div>
        </div>     
        <!--coryright-->
        <div class="container-fluid rem10">
            2018 - Made by Badik 🖕 with <i class="fas fa-heart red-text rem10"></i>
        </div>
        <!--end coryright-->
        <!--Scripts-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
        <script src="../assets/import/Materialize/js/materialize.min.js"></script>
        <script src="../assets/import/SweetAlert/sweetalert.min.js"></script>
        <script src="../assets/js/script.js"></script>
    </body>
</html>