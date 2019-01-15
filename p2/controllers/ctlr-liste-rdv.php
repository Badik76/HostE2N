<?php
// On instancie un nouvel objet $appointments avec comme classe appointments
$appointments = new appointments();
/* on test que $_GET['deleteThis'] n'est pas vide
 * si non vide, on attribue à $appointments id la valeur du get avec un htmlspecialchars pour la protection
 * et on applique la methode deleteAppointmentById
 */
if (!empty($_GET['deleteThis'])){
    $appointments->id = htmlspecialchars($_GET['deleteThis']);
    $appointments->deleteAppointmentById();
}
// On appel la methode getAppointmentsList dans l'objet $listAppointments
$listAppointments = $appointments->getAppointmentsList();

// on crée les variables page, limit et start pour définir la page sur laquelle nous nous trouvons, la limite de rdv à afficher et à partir de quelle ligne.
$page = (!empty($_GET['page']) ? htmlspecialchars($_GET['page']) : 1); // on utilise une ternaire pour définir la valeur de page
$limit = 5; // on souhaite afficher 10 rdv par page
$start = ($page - 1) * $limit; // on définit la valeur de $start via un simple calcul
// on definit le nombre de page via la fonction ceil qui arrondit à l'entier supérieur
$totalArray = $appointments->GetNumberTotalRows();
$total = $totalArray->totalRows;
$pagesMax = ceil($total / $limit);

if (isset($_GET['search']) && !empty($_GET['search'])){
    $listAppointments = $appointments->findAppointmentBySearch(htmlspecialchars($_GET['search']));  
    if (count($listPatients) == 0){
        $noMatch = true;
        $noMatchMessage = 'Nous ne trouvons aucune correspondance pour : ' . $_GET['search'];
    }
} else {
    // sinon on crée la tableau à l'aide de la méthode GetSomePatients
    $listAppointments = $appointments->GetSomeAppointments($start, $limit);
}

?>