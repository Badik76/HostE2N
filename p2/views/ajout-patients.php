<?php
include '../models/database.php';
include '../models/patients.php';
include '../controllers/ctlr-ajout-patient.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <!--Let browser know website is optimized for mobile-->
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
    </head>
    <body>
        <div class="container">
            <div class="card-panel">
                <form id="addPatient" action="ajout-patients.php" method="POST">
                    <div class="row">
                        <div class="col l6 s12">
                            <div class="container wrapper-align center-align left-part add">
                                <img class="responsive-img" src="../assets/img/ajoutpatient.jpg" alt="Cabinet médical"/>
                            </div>
                        </div>
                        <div class="input-field col l6 s12 center-align">
                            <h1>Enregistrement du Patient</h1>
                            <a href="../index.php" class="waves-effect waves-light btn"><i class="material-icons left">home</i>RETOUR</a>
                            <?php if ($addSuccess) { ?>
                                <h2><?= 'Patient enregistré !' ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($hideSuccess) { ?>
                        <div id="inputpatient">
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="lastname" name="lastname" type="text" class="validate" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+" />
                                    <label for="lastname">NOM <span class="error"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="firstname" name="firstname" type="text" class="validate" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+" />
                                    <label for="firstname">Prénom <span class="error"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="birthdate" name="birthdate" type="text" class="validate datepicker" />
                                    <label for="birthdate">Date de naissance (ex: 23/05/2000). <span class="error"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="phone" name="phone" type="tel" class="validate" pattern="((\+)33|0)[1-9](\d{2}){4}" />
                                    <label for="phone">Numéro de téléphone (ex: 0602030405). <span class="error"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                    <input id="mail" name="mail" type="email" class="validate" pattern="[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}" />
                                    <label for="mail">Adresse Mail (ex: mail@mail.fr). <span class="error"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></span></label>                            
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 center-align">
                                    <input name="addButton" type="submit" class="waves-effect waves-light btn teal" value="ENREGISTRER LE PATIENT"/>
                                    <span class="error"><?= isset($formError['add']) ? $formError['add'] : '' ?></span>
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