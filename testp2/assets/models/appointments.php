<?php
/* On crée une class appointments qui hérite de la classe database via extends
 * La classe appointments va nous permettre d'accéder à la table patients
 */
class appointments extends database {
    // Création d'attributs qui correspondent à chacun des champs de la table appointments
    // et on les initialise par rapport à leurs types.
    public $id = 0;
    public $dateHour = '01/01/2000';
    public $idPatients = 0;
    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }
    /**
     * On crée une methode qui insert un rendezvous dans la table appointments
     * @return type EXECUTE
     */
    public function addAppointment() {
        // Insertion des données du rendezvous à l'aide d'une requête préparée avec un INSERT INTO et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)';
        $addAppointment = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $addAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $addAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        // on utilise la méthode execute() via un return
        return $addAppointment->execute();
    }
    /**
     * On crée un methode qui vérifie si un rdv existe par rapport au patient
     * @return type BOOLEAN
     */
    public function checkFreeAppointment() {
        // on effectue un requete qui compte le nombre de ligne qui est égale à dateHour et idPatients
        // on place un marqueur nominatif pour récupérer les valeurs de dateHour et de idPatients
        $query = 'SELECT COUNT(*) AS `takenAppointment` FROM `appointments` WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients';
        $freeAppointment = $this->dataBase->prepare($query);
        // on attribue les valeurs de dateHour et idPatients aux marqueurs nominatifs respectifs
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        // on effectue une condition pour donner une valeure booleenne à $appointmentMatch
        if ($freeAppointment->execute()) {
            $appointmentMatch = $freeAppointment->fetch(PDO::FETCH_OBJ);
        } else {
            $appointmentMatch = false;
        }
        return $appointmentMatch;
    }
    /**
     * On crée un methode qui retourne la liste des RDV de la table appointments
     * @return type ARRAY
     */
    public function getAppointmentsList() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments et patients en effectuant une jointure
        // sur l'id et l'idpatient.
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,
                        DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                        `appointments`.`id`,
                        `patients`.`lastname`,
                        `patients`.`firstname`
                    FROM `appointments`
                    LEFT JOIN `patients`
                    ON `appointments`.`idPatients` = `patients`.`id`
                    ORDER BY `patients`.`lastname`';
        // On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $result = $this->dataBase->query($query);
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }
    /**
     * On crée un methode qui retourne la liste des RDV d'un patient selon son ID de la table appointments
     * @return type ARRAY
     */
    public function getAppointmentsListByIdPatients() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments et patients en effectuant une jointure
        // sur l'id et l'idpatient.
        $query = 'SELECT DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date`,
                        DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`,
                        `id`,
                        `idPatients`
                    FROM `appointments`                    
                    WHERE `idPatients` = :idPatients';
        // On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $findAppointments = $this->dataBase->prepare($query);
        $findAppointments->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $findAppointments->execute();
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $findAppointments->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }
    /**
     * On crée un methode qui retourne les valeurs de la ligne du tableau selon l'id de la table patients
     * @return BOOLEAN
     */
    public function getAppointmentById() {
        // on initialise la valeur de $isCorrect en false
        $isCorrect = false;
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments. L'id est egal à :id via marqueur nominatif sur id      
        $query = 'SELECT `id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `idPatients` FROM `appointments` WHERE `id`= :idAppointment';
        // On crée un objet $findAppointment qui utilise la fonction prepare avec comme paramètre $query        
        $findAppointment = $this->dataBase->prepare($query);
        // on attribue la valeur via bindValue et on recupère les attributs de la classe via $this
        $findAppointment->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
        // Si nous arrivons à executer l'objet $findAppointment, on crée un objet $appointment qui aura les valeirs de $findAppointment via un fetch
        if ($findAppointment->execute()) {
            $appointment = $findAppointment->fetch(PDO::FETCH_OBJ);
            // if imbriqué pour hydrater les valeurs
            // si $profil est un objet(existe dans la table), on attribue directement les valeurs de l'objet $appointment
            if (is_object($appointment)) {
                $this->id = $appointment->id;
                $this->date = $appointment->date;
                $this->hour = $appointment->hour;
                $this->idPatients = $appointment->idPatients;
                $isCorrect = true;
            }
        }
        return $isCorrect;
    }
    /**
     * On crée un methode met à jour les informations d'un rendez selon l'id de la table appointments
     * @return une requête UPDATE
     */
    public function updateAppointmentById() {
        // MAJ des données du rendez-vous à l'aide d'une requête préparée avec un UPDATE et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'UPDATE `appointments` SET `dateHour` = :dateHour, `idPatients` = :idPatients WHERE `id` = :idAppointment';
        $updateAppointment = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $updateAppointment->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
        $updateAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $updateAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        // on utilise la méthode execute() via un return
        return $updateAppointment->execute();
    }
    /**
     * On crée un methode qui efface un RDV selon l'id dans la table appointment
     * @return une requête execute un delete
     */
    public function deleteAppointmentById() {
        /* Effacer le rendez-vous à l'aide d'une requête préparée avec un DELETE et l'id de la ligne à effacer
         * IL EST IMPORTANT DE PRECISER LE WHERE POUR NE PAS EFFACER TOUTE LA TABLE
         * Insertion des valeurs des variables via les marqueurs nominatifs, ex :id).
         */
        $query = 'DELETE FROM `appointments` WHERE `id` = :id';
        $deleteAppointment = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $deleteAppointment->bindValue(':id', $this->id, PDO::PARAM_INT);
        // on utilise la méthode execute() via un return
        return $deleteAppointment->execute();
    }
    public function __destruct() {
        // On appelle le destruct du parent
        parent::__destruct();
    }
}