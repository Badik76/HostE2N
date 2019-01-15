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
?>