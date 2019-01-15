<?php
// CONTROLLER RENDEZVOUS.PHP
// On instancie un nouvel objet $patients avec comme classe patients
$patients = new patients();
$listPatients = $patients->getPatientsList();
// On instancie un nouvel objet $appointments avec comme classe appointments
$appointments = new appointments();
// j'attribue la valeur du valeur $_GET à l'attribue id de l'objet $appointments
if (isset ($_GET['idAppointment'])){
    $appointments->id = $_GET['idAppointment'];
}
//Création des regex pour controler les données du formulaire
$regexDate = '/^(0[1-9]|([1-2][0-9])|3[01])\/(0[1-9]|1[012])\/((19|20)[0-9]{2})$/';
$regexHour = '/([01]?[0-9]|2[0-3]):[0-5][0-9]/';
//Initialise $modifySuccess en False pour afficher message
$modifySuccess = false;
//Création d'un tableau pour retranscrire les erreurs lors du remplissage du formulaire
$formError = array();
//Création d'un tableau pour retranscrire les erreurs lors du choix du rdv
$appointmentChoiceError = array();
//On test la valeur date l'array $_POST pour savoir si elle existe
//Si ok, nous testons la valeur
if (isset($_POST['date'])) {
    // si ne correspond pas à la regex, on crée un message d'erreur personnalisé dans $formError
    if (!preg_match($regexDate, $_POST['date'])) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['date'] = 'La date doit être au format 30/10/1985';
    }
    // si vide, on crée un message d'erreur personnalisé dans $formError
    if (empty($_POST['date'])) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['date'] = '*Champs date obligatoire';
    }
}
//On test la valeur hour l'array $_POST pour savoir si elle existe
//Si ok, nous testons la valeur
if (isset($_POST['hour'])) {
    // si ne correspond pas à la regex, on crée un message d'erreur personnalisé dans $formError
    if (!preg_match($regexHour, $_POST['hour'])) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['hour'] = 'La date doit être au format 30/10/1985';
    }
    // si vide, on crée un message d'erreur personnalisé dans $formError
    if (empty($_POST['hour'])) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['hour'] = '*Champs heure obligatoire';
    }
}
//On test la valeur idPatient l'array $_POST pour savoir si elle existe
//Si nous attribuons à idPatients la valeur du $_POST
if (isset($_POST['idPatient'])) {
    $appointments->idPatients = $_POST['idPatient'];
    // OU si le formulaire a été validé mais que il n'y a pas d'élément sélectionné dans le menu déroulant
    // on crée un message d'erreur pour pouvoir l'afficher
    if (is_nan($appointments->idPatients)) {
        $formError['idPatient'] = '*Veuillez sélectionner uniquement un patient de la liste';
    }
} else if (isset($_POST['modifyButton']) && !array_key_exists('idPatient', $_POST)) {
    $formError['idPatient'] = '*Veuillez sélectionner un patient';
}
// On compte le nombre de valeur dans $formError et On vérifie que nous avons crée une entrée modifyButton dans l'array $_POST,
// Si tout est réuni :
// On formate la date en dateUS
// On concatène les valeurs de date et de hour, puis on éxécute la méthode addAppointment()
if (count($formError) == 0 && isset($_POST['modifyButton'])) {
    $date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
    $dateUs = $date->format('Y-m-d');
    $appointments->dateHour = $dateUs . ' ' . $_POST['hour'];
    // j'initialise une variable avec la valeur booléenne $appointments->checkFreeAppointment()
    $appointmentMatch = $appointments->checkFreeAppointment();
    // on test que $appointmentMatch n'est pas un objet
    // si ok, on crée un message d'erreur qui indique que la requête n'a pas été executé
    if (!is_object($appointmentMatch)) {
        $appointmentChoiceError['appointmentMatch'] = 'Un problème est survenu';
    } else {
        // sinon, si nous trouvons une ligne takenAppointment (return true), nous créons un message d'erreur
        if ($appointmentMatch->takenAppointment) {
            $appointmentChoiceError['takenAppointment'] = 'RDV non disponible';
        } else {            
            // si la requête n'a pas pu être effectuée, nous créons un message d'erreur pour dire que l'enregistrement à échoué
            if (!$appointments->updateAppointmentById()) {
                $formError['add'] = 'la modification a échoué';
            } else {
                // sinon, on execute notre requête pour enregistrer le RDV
                $modifySuccess = true;
            }
        }
    }
}
// Je créé un objet $appointmentIsFind avec la méthode getAppointmentById() qui me retourne une ligne de tableau
// Cet objet va me permettre d'afficher la valeur des différents attributs
$appointmentIsFind = $appointments->getAppointmentById();
?>