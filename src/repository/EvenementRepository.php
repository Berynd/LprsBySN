<?php

namespace repository;

use modele\Evenement;

class EvenementRepository
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Evenement $evenement)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM evenement WHERE titre = :titre');
        $req2->execute(array(
            'titre' => $evenement->getTitreEvenement(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO evenement(type,titre,description,lieu,element_requis,nombre_place,date_creation,etat)
                Values (:type,:titre,:description,:lieu,:element_requis,:nombre_place,:date_creation,:etat)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'type' => $evenement->getTypeEvenement(),
                'description' => $evenement->getDescriptionEvenement(),
                'lieu' => $evenement->getLieuEvenement(),
                'element_requis' => $evenement->getElementRequis(),
                'nombre_place' => $evenement->getNombrePlace(),
                'date_creation' => $evenement->getDateCreationEvenement(),
                'etat' => $evenement->getEtatEvenement()
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "L'évènement a été crée ! ";
                header('Location: ***');
            } else {
                return false;
            }
            exit();
        } else {
            echo "L'évènement existe déjà existe déjà ! ";
            header('Location: ***');
            exit();
        }
    }

    public function listeEvenement()
    {
        $sqlEvenement = 'SELECT * FROM evenement';
        $reqEvenement = $this->bdd->getBDD()->prepare($sqlEvenement);
        $reqEvenement->execute();

        return $reqEvenement->fetchAll();
    }

    public function nombreEvenement()
    {
        $sqlnombreevenement = 'SELECT COUNT(*) FROM evenement';
        $reqnombreevenement = $this->bdd->getBdd()->prepare($sqlnombreevenement);
        $reqnombreevenement->execute(array());

        return $reqnombreevenement->fetchColumn();

    }

    public function suppression(Evenement $evenement)
    {
        $sqlsuppression = 'DELETE FROM evenement WHERE id_evenement = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $evenement->getIdEvenement()
        ));
        header("Location: ***");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Evenement $evenement)
    {
        $sqlmodification = "UPDATE evenement SET type = :type, titre = :titre, description = :description, lieu = :lieu, element_requis = :element_requis, nombre_place = :nombre_place, date_creation = :date_creation, etat = :etat WHERE id_evenement = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'type' => $evenement->getTypeEvenement(),
            'titre' => $evenement->getTitreEvenement(),
            'description' => $evenement->getDescriptionEvenement(),
            'lieu' => $evenement->getLieuEvenement(),
            'element_requis' => $evenement->getElementRequis(),
            'nombre_place' => $evenement->getNombrePlace(),
            'date_creation' => $evenement->getDateCreationEvenement(),
            'etat' => $evenement->getEtatEvenement(),
            'id' => $evenement->getIdEvenement()
        ));
        header("Location: ***");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}