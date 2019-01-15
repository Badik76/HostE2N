<?php
include '../models/database.php';
include '../models/patients.php';
include '../models/appointments.php';
include '../controllers/ctlr-ajout-rdv.php'
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
            <div class="card-panel">
                <form id="addPatient" action="ajout-rdv.php" method="POST">
                    <div class="row">
                        <div class="col l6 s12">
                            <div class="container wrapper-align center-align left-part add">
                                <img class="responsive-img" src="../assets/img/prendrerdv.jpeg" alt="Cabinet médical"/>
                            </div>
                        </div>
                        <div class="col l6 s12">                    
                            <div class="input-field col s12 center-align">
                                <h2>Prise de RDV</h2>
                                <a href="../index.php" class="waves-effect waves-light btn"><i class="material-icons left">home</i>RETOUR</a>
                            </div>
                        </div>
                        <?php if ($addSuccess) { ?>
                            <h2><?= 'Rendez-vous bien enregistré !' ?></h2>
                        <?php } ?>
                            <?php if ($hideSuccess) { ?>
                            <div id="inputrdv">
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="date" name="date" type="text" class="datepicker" /> 
                                    <label for="date">Date</label>
                                    <p class="error"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="hour" name="hour" type="text" class="timepicker" /> 
                                    <label for="heure">Heure</label>
                                    <p class="error"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <select id="idPatient" name="idPatient">
                                        <option value="0" disabled selected>Choix du patient</option>
                                        <?php foreach ($getPatients AS $patient) { ?>
                                            <option value="<?= $patient->id ?>"><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="idPatient">Nom du patient</label>
                                    <p class="error"><?= isset($formError['idPatient']) ? $formError['idPatient'] : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 center-align">
                                    <input name="addButton" type="submit" class="waves-effect waves-light btn teal" value="ENREGISTRER LE RDV"/>
                                    <?php foreach ($formError AS $error) { ?>
                                        <p class="error"><?= $error ?></p>
                                    <?php } ?>                            
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                </form>
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