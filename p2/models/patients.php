<?php

/* On crée une class patients qui hérite de la classe database via extends
 * La classe patients va nous permettre d'accéder à la table patients
 */

class patients extends database {
    // Création d'attributs qui correspondent à chacun des champs de la table patients
    // et on les initialise par rapport à leurs types.
    
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '01/01/2000';
    public $phone = 0231443656;
    public $mail = '';
    
    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }
    
    /**
     * On crée une methode qui insert un patient dans la table patient
     * @return type EXECUTE
     */
    public function addPatient() {
        // Insertion des données du patient à l'aide d'une requête préparée avec un INSERT INTO et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $addPatient = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $addPatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $date = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $dateUs = $date->format('Y-m-d');
        // a modif plus simple et mieux.
        $addPatient->bindValue(':birthdate', $dateUs, PDO::PARAM_STR);
        $addPatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $addPatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // on utilise la méthode execute() via un return
        return $addPatient->execute();
    }
    
    /**
     * On crée un methode qui retourne la liste des patients de la table patients
     * @return type ARRAY
     */
    public function getPatientsList() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table patients
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` ORDER BY `lastname`';
        // On crée un objet $result qui exécute la méthode query() avec comme paramètre $query
        $result = $this->dataBase->query($query);
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        // On retourne le resultat
        return $resultList;
    }
    
    /**
     * On crée un methode qui retourne un tableau qui contient les informations d'un patient selon l'id de la table patients
     * @return BOOLEAN
     */
    public function getProfilById() {
        $isCorrect = false;
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table patients l'id est egal à :id via marqueur nominatif sur id
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :idPatient';
        // On crée un objet $findProfil qui utilise la fonction prepare avec comme paramètre $query        
        $findProfil = $this->dataBase->prepare($query);
        // on attribue la valeur via bindValue et on recupère les attributs de la classe via $this
        $findProfil->bindValue(':idPatient', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()){
            $profil = $findProfil->fetch(PDO::FETCH_OBJ);
            // if imbriqué pour remplir les valeurs
            // si $profil est un objet(existe dans la table), on attribue directement les valeurs de l'objet $profil
            if (is_object($profil)){
                $this->lastname = $profil->lastname;
                $this->firstname = $profil->firstname;
                $this->birthdate = $profil->birthdate;
                $this->phone = $profil->phone;
                $this->mail = $profil->mail;  
                $isCorrect = true;
            }
        }        
        return $isCorrect;
    }
    
    /**
     * On crée un methode met à jour les informations d'un patient selon l'id de la table patients
     * @return BOOLEAN
     */
    
    public function updateProfilById() {
        // MAJ des données du patient à l'aide d'une requête préparée avec un UPDATE et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :idPatient';
        $updatePatient = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $updatePatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $updatePatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $date = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $dateUs = $date->format('Y-m-d');
        $updatePatient->bindValue(':birthdate', $dateUs, PDO::PARAM_STR);
        $updatePatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updatePatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updatePatient->bindValue(':idPatient', $this->id, PDO::PARAM_INT);
        // on utilise la méthode execute() via un return
        return $updatePatient->execute();
    } 
    
    /**
     * On crée un methode qui supprime une ligne de la table ainsi que les lignes de la table appointments associée
     * Contrôle de la QUERY via un commit et rollback
     * @return EXECUTE QUERY
     */
    public function deletePatientAndAppointments() {
        // on met en place les attributs du PDO $dataBase avec ATTR_ERRMODE et ERRMODE_EXCEPTION pour genérer des message en cas d'erreur
        $this->dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            // On démarre notre transaction sur notre PDO dataBase
            $this->dataBase->beginTransaction();            
            // On crée notre requête pour effacer les rendez vous
            $deleteAppointmentsQuery = 'DELETE FROM `appointments` WHERE `idPatients` = :idPatients';
            // on prépare la requete avec un marqueur nominatif qui récuperera la valeur de l'idPatients  
            $deleteAppointments = $this->dataBase->prepare($deleteAppointmentsQuery);
            $deleteAppointments->bindValue(':idPatients', $this->id, PDO::PARAM_INT);
            // on execute la requete pour effacer le ou les rendez-vous
            $deleteAppointments->execute();            
            // On crée notre requête pour effacer le patient
            $deletePatientQuery = 'DELETE FROM `patients` WHERE `id` = :id';
            // on prépare la requete avec un marqueur nominatif qui récuperera la valeur de l'id  
            $deletePatient = $this->dataBase->prepare($deletePatientQuery);
            $deletePatient->bindValue(':id', $this->id, PDO::PARAM_INT);
            // on execute la requete pour effacer le patient
            $deletePatient->execute();                        
            // si tout s'est bien déroule on valide la transaction via un commit
            $this->dataBase->commit();        
        } catch (Exception $errorMessage){ // en cas d'erreur on stock le message dans $errorMessage
            // Si erreur, on annule la transaction via un rollback
            $this->dataBase->rollback();
            echo 'Erreur : ' . $errorMessage->getMessage(); // On affiche le message d'erreur avec la methode getMessage
        }         
    }
    
    /**
     * On crée un methode qui va effectuer une recherche de patients dans la table patients
     * @return ARRAY
     */
    public function findPatientsBySearch($search) {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table patients
        // On utilise un LIKE qui nous permettra d'afficher la liste selon un critère non précis
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` WHERE `lastname` LIKE :search ORDER BY `lastname`';
        // On crée un objet $result qui exécute la méthode query() avec comme paramètre $query
        $result = $this->dataBase->prepare($query);
        // nous attribuons au marqueur nominatif search la valeur de $search
        $result->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $result->execute();
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        // On retourne le resultat
        return $resultList;
    }
    
    /**
     * On crée un methode qui va effectuer une recherche de patients dans la table patients selon un début et une limite
     * @return ARRAY
     */
    // Création d'une function GetSomePatients avec 2 paramètres de fonction $debut et $limit
    public function GetSomePatients($start, $limit) {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table patients
        // On utilise LIMIT et OFFSET qui nous permettra d'afficher la liste via une pagination
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate` FROM `patients` ORDER BY `lastname` LIMIT :limit OFFSET :start';
        // On crée un objet $result qui exécute la méthode query() avec comme paramètre $query
        $result = $this->dataBase->prepare($query);
        // nous attribuons au marqueur nominatif limit et start leurs valeurs respectifs via les paramètres de fonction
        $result->bindValue(':start', $start, PDO::PARAM_INT);
        $result->bindValue(':limit', $limit, PDO::PARAM_INT);
        $result->execute();
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        // On retourne le resultat
        return $resultList;
    }
    
    /**
     * On crée un methode qui va calculer le nombre de ligne de la table patients
     * @return ARRAY contenant la valeur du nombre de ligne dans le champ totalRows
     */
    public function GetNumberTotalRows() {
        // on crée un requête pour calculer le nombre total de ligne de la table patients
        $query = 'SELECT COUNT(`id`) AS `totalRows` FROM `patients`';
        $totalRows = $this->dataBase->query($query);
        $result = $totalRows->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function __destruct() {
        // On appelle le destruct du parent
        parent::__destruct();
    }
}