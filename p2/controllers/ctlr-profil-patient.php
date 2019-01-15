<?php
// CONTROLLER PROFIL-PATIENTS.PHP
// On instancie un nouvel objet $patients avec pour classe patients
$patients = new patients();
// on instancie un nouvel objet $appointments avec pour model appointments
$appointments = new appointments();
// j'attribue la valeur du valeur $_GET à l'attribue id de l'objet $patients et l'attribue idPatients de l'objet $appointments
if (isset ($_GET['idPatient'])){
    $patients->id = $_GET['idPatient'];
    $appointments->idPatients = $_GET['idPatient'];    
}
/* on execute la méthode getProfilById qui va hydrater les valeurs dans patients
 * elle va également nous retourner un boolean qui nous indiquera si la requête s'est bien executée
 */
$profilIsFind = $patients->getProfilById();
// on crée un tableau $appointmentsList via la méthode getAppointmentsList()
$appointmentsList = $appointments->getAppointmentsListByIdPatients();
//Création des regex pour controler les données du formulaire lors de l'enregistrement des modifications
$regexName = '/^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+$/';
$regexBirthdate = '/^(0[1-9]|([1-2][0-9])|3[01])\/(0[1-9]|1[012])\/((19|20)[0-9]{2})$/';
$regexEmail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/'; // regex date au format yyyy-mm-dd
$regexPhoneNumber = '/^[0-9]{10,10}$/';
//Initialise $addSuccess en False pour afficher message
$addSuccess = false;
//Initialise $HadAppointments en False pour afficher message
$noAppointments = false;
//Création d'un tableau pour retranscrire les erreurs lord du remplissage du formulaire
$formError = array();
//On test la valeur lastname dans l'array $_POST, si elle existe via premier if
if (isset($_POST['lastname'])) {
    // Variable lastname qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $patients->lastname = htmlspecialchars($_POST['lastname']);
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexName, $patients->lastname)) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['lastname'] = 'Votre nom ne doit contenir que des lettres';
    }
    // Si le post lastname n'est pas rempli (donc vide)
    if (empty($patients->lastname)) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['lastname'] = 'Champs obligatoire';
    }
}
//On test la valeur firstname dans l'array $_POST, si elle existe via premier if
if (isset($_POST['firstname'])) {
    // Variable firstname qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $patients->firstname = htmlspecialchars($_POST['firstname']);
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexName, $patients->firstname)) {
        // J'affiche l'erreur
        $formError['firstname'] = 'Votre prénom ne doit contenir que des lettres';
    }
    // Si le post est vide
    if (empty($patients->firstname)) {
        // J'affiche le message d'erreur
        $formError['firstname'] = 'Champs obligatoire';
    }
}
//On test la valeur birthdate dans l'array $_POST, si elle existe via premier if
if (isset($_POST['birthdate'])) {
    // Variable birthdate qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $patients->birthdate = $_POST['birthdate'];
        // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexBirthdate, $patients->birthdate)) {
        // J'affiche l'erreur
        $formError['birthdate'] = 'Votre date de naissance doit être de type 1980-12-31';
    }
    // Si le post est vide
    if (empty($patients->birthdate)) {
        // J'affiche le message d'erreur
        $formError['birthdate'] = 'Champs obligatoire';
    }
}
//On test la valeur phone dans l'array $_POST, si elle existe via premier if
if (isset($_POST['phone'])) {
    // Variable phone qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $patients->phone = htmlspecialchars($_POST['phone']);
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexPhoneNumber, $patients->phone)) {
        // J'affiche l'erreur
        $formError['phone'] = 'Votre numéro de téléphone doit contenir 10 chiffres et doit être de type 0620300405';
    }
    // Si le post est vide
    if (empty($patients->phone)) {
        // J'affiche le message d'erreur
        $formError['phone'] = 'Champs obligatoire';
    }
}
//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['mail'])) {
    // Variable mail qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $patients->mail = $_POST['mail'];
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexEmail, $patients->mail)) {
        // J'affiche l'erreur
        $formError['mail'] = 'Votre mail doit être du type mail@mail.com';
    }
    // Si le post est vide
    if (empty($patients->mail)) {
        // J'affiche le message d'erreur
        $formError['mail'] = 'Champs obligatoire';
    }
}
//on vérifie que nous avons crée une entrée submit dans l'array $_POST, si présent on éxécute la méthode updateProfilById()
  if (count($formError) == 0 && isset($_POST['updateButton'])){
    if (!$patients->updateProfilById()){
        $formError['update'] = 'l\'envoie du formulaire à échoué';
    } else {
        $addSuccess = true;
    }
}
//on compte l'array $appointmentsList pour savoir s'il est vide, si vide on donne la valeur true à $NoAppointment
if (count($appointmentsList) == 0){
    $noAppointments = true;
}
?>