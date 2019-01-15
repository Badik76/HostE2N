<?php
// On instancie un nouvel objet $patients avec comme classe patients
$patients = new patients();
//// on crée un variable $searchList qu'on initialise en false pour definir la liste à afficher par la suite.
//$searchList = false;
/* on crée une variable $noMatch qu'on initialise à false,  
 * on se servira de cette variable pour afficher un message si nous ne trouvons pas de correspondance lors de la recherche
 */
$noMatch = false;
/* on crée un variable $deleteOk qu'on initialise à false
 * cette variable va nous permettre d'afficher un message lors de la suppression d'un patient
 */
$deleteOk = false;
// on crée les variables page, limit et start pour définir la page sur laquelle nous nous trouvons, la limite de patients à afficher et à partir de quelle ligne.
$page = (!empty($_GET['page']) ? htmlspecialchars($_GET['page']) : 1); // on utilise une ternaire pour définir la valeur de page
$limit = 5; // on souhaite afficher 5 patients par page
$start = ($page - 1) * $limit; // on définit la valeur de $start via un simple calcul
// on definit le nombre de page via la fonction ceil qui arrondit à l'entier supérieur
$totalArray = $patients->GetNumberTotalRows();
$total = $totalArray->totalRows;
$pagesMax = ceil($total / $limit);
/* on test que $_GET['deleteThis'] n'est pas vide
 * si non vide, on attribue à $patients id la valeur du get avec un htmlspecialchars pour la protection
 * et on applique la methode deletePatientAndAppointmentsById pour effacer le patient
 */
if (!empty($_GET['deleteThis'])){
    $patients->id = htmlspecialchars($_GET['deleteThis']);
    $patients->deletePatientAndAppointments();
    $deleteOk = true;
}
/* on test que $_GET['search'] et qu'il n'est pas vide
 * si ok, on crée un tableau avec la methode findPatientsBySearch avec comme paramètre $_GET['search']
 * on fait un si imbrique pour tester si le tableau est vide via un count, si vide crée un message d'erreur pour $noMatchMessage
 */
if (isset($_GET['search']) && !empty($_GET['search'])){
    $listPatients = $patients->findPatientsBySearch(htmlspecialchars($_GET['search']));  
    if (count($listPatients) == 0){
        $noMatch = true;
        $noMatchMessage = 'Nous ne trouvons aucune correspondance pour : ' . $_GET['search'];
    }
} else {
    // sinon on crée la tableau à l'aide de la méthode GetSomePatients
    $listPatients = $patients->GetSomePatients($start, $limit);
}