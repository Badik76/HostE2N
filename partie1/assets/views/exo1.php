<?php
//appelle le controllers de la view
include('../controllers/ctrl1.php');
$reponse = try1();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>PDO - Partie 1</title>
        <link rel="shortcut icon" href="./assets/img/doigt.png"/>
        <meta name="author" content="Badik76" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
        <link href="https://fonts.googleapis.com/css?family=Thasadith" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="./assets/import/Materialize/css/materialize.min.css"  media="screen" />
        <!-- Import personnal stylesheet -->
        <link type="text/css" rel="stylesheet" href="./assets/css/style.css" />
        <!--Let browser know website is optimized for mobile-->
    </head>
    <body>
        <!--navbar-->
        <header>
            <div class="navbar-fixed">
                <nav class="backgroundcolor">
                    <div class="nav-wrapper">
                        <a href="index.php" class="brand-logo">Acceuil</a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="index.php?p1=exo1">exo1</a></li>
                            <li><a href="index.php?p1=exo2">exo2</a></li>
                            <li><a href="index.php?p1=exo3">exo3</a></li>
                            <li><a href="index.php?p1=exo4">exo4</a></li>
                            <li><a href="index.php?p1=exo5">exo5</a></li>
                            <li><a href="index.php?p1=exo6">exo6</a></li>
                            <li><a href="index.php?p1=exo7">exo7</a></li>
                        </ul>
                    </div>
                </nav>   
            </div>
            <div class="container">
                <table class="responsive-table highlight">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Anniversaire</th>
                            <th>Carte</th>
                            <th>Numéro de carte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Boucle foreach pour lire le tableau ligne par ligne -->
                        <?php while ($donnees = $reponse->fetch()) { ?>
                            <tr>
                                <td><?= $donnees['id']; ?></td>
                                <td><?= $donnees['NomClient']; ?></td>
                                <td><?= $donnees['PrénomClient']; ?></td>
                                <td><?= $donnees['Anniversaire']; ?></td>
                                <td><?= $donnees['Carte']; ?></td>
                                <td><?= $donnees['cardNumber']; ?></td>
                            </tr>
                            <?php
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                        ?>
                    </tbody>
                </table>
            </div>
            <!--end navbar-->
        </header>
        <!--coryright-->
        <div class="container-fluid rem10">
            2018 - Made by Badik 🖕 with <i class="fas fa-heart red-text rem10"></i>
        </div>
        <!--end coryright-->
        <!--Scripts-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
        <script src="assets/import/Materialize/js/materialize.min.js"></script>
        <script src="assets/import/SweetAlert/sweetalert.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>