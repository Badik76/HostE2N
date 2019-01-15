<?php
//test pour entrer dans la base de donnée
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'badik', 'root');
} catch (Exception $e) {
    die('Erreur rencontrée : ' . $e->getMessage());
}

// on crée une requête pour l'exo1 qu'on stock dans $query1
$query1 = ('SELECT `clients`.`id` as `id`, DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`, `clients`.`card` as `Carte`, `clients`.`cardNumber` as `cardNumber`, `clients`.`lastName` as `NomClient`, `clients`.`firstName` as `PrénomClient` FROM `clients` ORDER BY `NomClient` ');
// on execute la requête $query1 qu'on stock dans $reponse
$reponse = $bdd->query($query1);
//on crée une requête pour l'exo2 qu'on stock dans $query2

$query2 = ('SELECT type FROM `showTypes`');
$reponse2 = $bdd->query($query2);

$query3 = ('SELECT DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`, `clients`.`card` as `Carte`, `clients`.`cardNumber` as `cardNumber`, `clients`.`lastName` as `NomClient`, `clients`.`firstName` as `PrénomClient`  FROM `clients` LIMIT 0, 20');
$reponse3 = $bdd->query($query3);

$query4 = ('SELECT DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`,`clients`.`card` as `Carte`,`clients`.`cardNumber` as `cardNumber`,`clients`.`lastName` as `NomClient`,`clients`.`firstName` as `PrénomClient`FROM `clients` WHERE `card` = "1"');
$reponse4 = $bdd->query($query4);

$query5 = ('SELECT DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`,`clients`.`card` as `Carte`,`clients`.`cardNumber` as `cardNumber`,`clients`.`lastName` as `NomClient`,`clients`.`firstName` as `PrénomClient`FROM `clients` WHERE `lastName` LIKE "M%" ORDER BY `lastName`');
$reponse5 = $bdd->query($query5);

$query6 = ('SELECT `title`, `performer`, DATE_FORMAT(`date`, "%d/%m/%Y") as `jour`, startTime FROM `shows` ORDER BY title');
$reponse6 = $bdd->query($query6);

$query7 = ('SELECT DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`, `clients`.`cardNumber` as `cardNumber`, `clients`.`lastName` as `NomClient`, `clients`.`firstName` as `PrénomClient`, CASE `card` WHEN 1 THEN "oui" ELSE "non" END as `Carte` FROM `clients`');
$reponse7 = $bdd->query($query7);
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
                            <li><a href="#exo1">exo1</a></li>
                            <li><a href="#exo2">exo2</a></li>
                            <li><a href="#exo3">exo3</a></li>
                            <li><a href="#exo4">exo4</a></li>
                            <li><a href="#exo5">exo5</a></li>
                            <li><a href="#exo6">exo6</a></li>
                            <li><a href="#exo7">exo7</a></li>
                        </ul>
                    </div>
                </nav>  
            </div>
        </header>

        <div class="container" id="exo1">
            <h1>Exercice 1 Partie 1</h1>
            <p class="flow-text">Afficher tous les clients.</p>
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
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $donnees-->
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

        <div class="container" id="exo2">
            <h1>Exercice 1 Partie 2</h1>
            <p class="flow-text">Afficher tous les types de spectacles possibles.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Type de Concert</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $showType-->
                    <?php while ($showType = $reponse2->fetch()) { ?>
                        <tr>
                            <td><?= $showType['type']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse2->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container" id="exo3">
            <h1>Exercice 1 Partie 3</h1>
            <p class="flow-text">Afficher les 20 premiers clients.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Anniversaire</th>
                        <th>Carte</th>
                        <th>Numéro de carte</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $twentyclients-->
                    <?php while ($twentyclients = $reponse3->fetch()) { ?>
                        <tr>
                            <td><?= $twentyclients['NomClient']; ?></td>
                            <td><?= $twentyclients['PrénomClient']; ?></td>
                            <td><?= $twentyclients['Anniversaire']; ?></td>
                            <td><?= $twentyclients['Carte']; ?></td>
                            <td><?= $twentyclients['cardNumber']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse3->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container" id="exo4">
            <h1>Exercice 1 Partie 4</h1>
            <p class="flow-text">N'afficher que les clients possédant une carte de fidélité.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Anniversaire</th>
                        <th>Carte</th>
                        <th>Numéro de carte</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $cardclients-->
                    <?php while ($cardclients = $reponse4->fetch()) { ?>
                        <tr>
                            <td><?= $cardclients['NomClient']; ?></td>
                            <td><?= $cardclients['PrénomClient']; ?></td>
                            <td><?= $cardclients['Anniversaire']; ?></td>
                            <td><?= $cardclients['Carte']; ?></td>
                            <td><?= $cardclients['cardNumber']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse4->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container" id="exo5">
            <h1>Exercice 1 Partie 5</h1>
            <p>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M". Les afficher comme ceci :<br />
                <strong>Nom :</strong> Nom du client<br />
                <strong>Prénom :</strong> Prénom du client<br />
                Trier les noms par ordre alphabétique.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $mclients-->
                    <?php while ($mclients = $reponse5->fetch()) { ?>
                        <tr>
                            <td><?= $mclients['NomClient']; ?></td>
                            <td><?= $mclients['PrénomClient']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse5->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container" id="exo6">
            <h1>Exercice 1 Partie 6</h1>
            <p class="flow-text">Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, la date et l'heure.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Spectacle</th>
                        <th>Artiste</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $allspect-->
                    <?php while ($allspect = $reponse6->fetch()) { ?>
                        <tr>
                            <td><?= $allspect['title']; ?></td>
                            <td><?= $allspect['performer']; ?></td>
                            <td><?= $allspect['jour']; ?></td>
                            <td><?= $allspect['startTime']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse6->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container" id="exo7">
            <h1>Exercice 1 Partie 7</h1>
            <p class="flow-text">Afficher tous les clients comme ceci :<br />
                <strong>Nom :</strong> Nom de famille du client<br />
                <strong>Prénom :</strong> Prénom du client<br />
                <strong>Date de naissance :</strong> Date de naissance du client<br />
                <strong>Carte de fidélité :</strong> Oui (Si le client en possède une) ou Non (s'il n'en possède pas)<br />
                <strong>Numéro de carte :</strong> Numéro de la carte fidélité du client s'il en possède une.</p>
        </div>
        <div class="container">
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Carte de fidélité - Numéro de carte</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    on demande à chercher tous les résultats qu'on stock dans $allclients-->
                    <?php while ($allclients = $reponse7->fetch()) { ?>
                        <tr>
                            <td><?= $allclients['NomClient']; ?></td>
                            <td><?= $allclients['PrénomClient']; ?></td>
                            <td><?= $allclients['Anniversaire']; ?></td>
                            <td><?= $allclients['Carte']; ?></td>
                            <td><?= $allclients['cardNumber']; ?></td>
                        </tr>
                        <?php
                    }
                    $reponse7->closeCursor(); // Termine le traitement de la requête
                    ?>
                </tbody>
            </table>
        </div>
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