<?php
include '../models/database.php';
include '../models/patients.php';
include '../controllers/ctlr-ajout-patient.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>E2N - L'Hosto du Pauvre !</title>
        <link rel="shortcut icon" href="../img/doigt.png"/>
        <meta name="author" content="Badik76" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
        <link href="https://fonts.googleapis.com/css?family=Thasadith" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../import/Materialize/css/materialize.min.css"  media="screen" />
        <!-- Import personnal stylesheet -->
        <link type="text/css" rel="stylesheet" href="../css/style.css" />
        <!--Let browser know website is optimized for mobile-->
    </head>
    <body>
        <div class="container">
            <div class="card-panel">
                <form id="addPatient" action="ajout-patients.php" method="POST">
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <h1>Enregistrement du patient</h1>
                            <a href="index.php" class="waves-effect waves-light btn"><i class="material-icons left">home</i>RETOUR</a>
                            <?php if ($addSuccess) { ?>
                                <h2><?= 'Patient bien enregistré !' ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="lastname" name="lastname" type="text" class="validate" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>"/>
                            <label for="lastname">NOM <span class="error"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="firstname" name="firstname" type="text" class="validate" />
                            <label for="firstname">Prénom <span class="error"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="birthdate" name="birthdate" type="text" class="validate" />
                            <label for="birthdate">Date de naissance (ex: 23/05/2000). <span class="error"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="phone" name="phone" type="tel" class="validate" />
                            <label for="phone">Numéro de téléphone (ex: 0602030405). <span class="error"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="mail" name="mail" type="email" class="validate" />
                            <label for="mail">Adresse Mail (ex: mail@mail.fr). <span class="error"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></span></label>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <input name="addButton" type="submit" value="ENREGISTRER LE PATIENT"/>
                            <span class="error"><?= isset($formError['add']) ? $formError['add'] : '' ?></span>
                        </div>
                    </div>
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
        <script src="../import/Materialize/js/materialize.min.js"></script>
        <script src="../import/SweetAlert/sweetalert.min.js"></script>
        <script src="../js/script.js"></script>
    </body>
</html>