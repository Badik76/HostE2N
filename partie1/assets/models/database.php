<?php

// création fonction qui permettra la connexion à la base de donnée

function cobdd() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'badik', 'root');
            return $bdd;
    } catch (Exception $e) {
        die('Erreur rencontrée : ' . $e->getMessage());
    }
}

?>