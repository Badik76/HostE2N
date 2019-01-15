<?php
function try1() {
$co = cobdd();
// on crée une requête qu'on stock dans $query
$query = ('SELECT `clients`.`id` as `id`, DATE_FORMAT(`clients`.`birthDate`, "%d/%m/%Y") as `Anniversaire`, `clients`.`card` as `Carte`, `clients`.`cardNumber` as `cardNumber`, `clients`.`lastName` as `NomClient`, `clients`.`firstName` as `PrénomClient` FROM `clients` ORDER BY `NomClient` ');
// on execute la requête $query qu'on stock dans $result
$reponse = $co->query($query);
// on demande à chercher tous les résultats qu'on stock dans $donnees   
return $reponse;
}
?>