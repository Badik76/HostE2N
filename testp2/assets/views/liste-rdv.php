<?php
include '../models/database.php';
include '../models/patients.php';
include '../models/appointments.php';
include '../controllers/ctlr-liste-rdv.php'
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
                <h1>Liste des RDV</h1>               
                <a href="ajout-rdv.php" class="waves-effect waves-light btn"><i class="material-icons left">event_note</i>ENREGISTRER RDV</a>
                <a href="index.php" class="waves-effect waves-light btn"><i class="material-icons left">home</i>RETOUR</a>
                <table class="responsive-table striped bordered table-patient">
                    <thead>
                        <tr>
                            <th>NOM</th>
                            <th>Prénom</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Détails</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- utilisation de la boucle foreach pour parcourir le tableau $listPatients avec comme alias $patient-->
                        <?php foreach ($listAppointments AS $appointments) { ?>
                            <tr>                           
                                <td><?= $appointments->lastname ?></td>
                                <td><?= $appointments->firstname ?></td>
                                <td><?= $appointments->date ?></td>
                                <td><?= $appointments->hour ?></td>
                                <!-- On récupère l'id à traver un paramètre d'URL idAppointment -->
                                <td><a href="rendezvous.php?idAppointment=<?= $appointments->id ?>"><i class="material-icons">info</i></a></td>
                                <td><a class="modal-trigger" href="#modal<?= $appointments->id ?>"><i class="material-icons">delete_forever</i></a>
                                    <!-- Structure du modal pour valider le delete -->
                                    <div id="modal<?= $appointments->id ?>" class="modal">
                                        <div class="modal-content center-align">
                                            <p>Rendez-vous à supprimer :</p>
                                            <ul>
                                                <li><?= $appointments->lastname . ' ' . $appointments->firstname ?></li>
                                                <li><?= $appointments->date ?></li>
                                                <li><?= $appointments->hour ?></li>
                                            </ul>
                                            <p>!! Attention la suppression est irréversible !!</p>
                                        </div>
                                        <div class="modal-footer center-align">
                                            <a href="liste-rdv.php?deleteThis=<?= $appointments->id ?>" class="modal-action modal-close waves-effect waves-red btn-flat">SUPPRIMER</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?> 

                    </tbody>
                </table>        
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