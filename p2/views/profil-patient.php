<?php
include '../models/database.php';
include '../models/patients.php';
include '../models/appointments.php';
include '../controllers/ctlr-profil-patient.php'
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
                <?php if ($profilIsFind) { ?>
                    <h2><?= $patients->lastname . ' ' . $patients->firstname ?></h2>
                <?php } else { ?>
                    <h2>Désolé</h2>
                <?php } ?>
            </div>
            <div class="card-panel">
                <?php if ($addSuccess) { ?>
                    <p>Les modifications ont bien été prises en compte</p>.
                <?php } ?>                

                <?php if ($profilIsFind) { ?>
                    <form id="addPatient" action="profil-patient.php?idPatient=<?= $patients->id ?>" method="POST">
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="lastname" name="lastname" type="text" value="<?= $patients->lastname ?>" class="validate" />
                                <p class="error"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
                                                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="firstname" name="firstname" type="text" value="<?= $patients->firstname ?>" class="validate" />
                                                                <p class="error"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="birthdate" name="birthdate" type="text" value="<?= $patients->birthdate ?>" class="validate" />
                                                                <p class="error"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="phone" name="phone" type="tel" value="<?= $patients->phone ?>" class="validate" />
                                                              <p class="error"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 l8 offset-l2">
                                <input id="mail" name="mail" type="email" value="<?= $patients->mail ?>" class="validate" />
                                                          <p class="error"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <h2 class="center-align">Liste des rendez-vous du patient</h2>
                            <?php if ($noAppointments) { ?>
                                <p class="center-align alerte">Pas de rendez-vous de programmé</p>
                            <?php } else { ?>
                                <table class="striped centered responsive-table col s12 grey lighten-2">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Détails</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appointmentsList AS $appointment) { ?>
                                            <tr>
                                                <td><?= $appointment->date ?></td>
                                                <td><?= $appointment->hour ?></td>
                                                <td><a href="rendez-vous.php?idAppointment=<?= $appointment->id ?>"><i class="material-icons">folder</i></a></td>                                        
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 center-align">
                                <input name="updateButton" type="submit" class="waves-effect waves-light btn teal" value="Enregistrer Modification(s)"/>
                                <p class="error"><?= isset($formError['update']) ? $formError['update'] : '' ?></p>
                                <a href="liste-patients.php" class="waves-effect waves-light btn"><i class="material-icons left">people</i>RETOUR LISTE PATIENT(S)</a>
                            </div>
                        </div>
                    </form>                    
                <?php } else { ?>
                    <div class="center-align">
                        <p>Ce patient n'a pas été trouvé.</p>
                        <a href="liste-patients.php" class="waves-effect waves-light btn"><i class="material-icons left">people</i>RETOUR LISTE PATIENT(S)</a>
                    </div>
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
        <script src="../import/Materialize/js/materialize.min.js"></script>
        <script src="../import/SweetAlert/sweetalert.min.js"></script>
        <script src="../js/script.js"></script>
    </body>
</html>