<?php

namespace repository;

class CandidatureRepository
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Candidature $candidature)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM candidature WHERE motivation = :motivation');
        $req2->execute(array(
            'motivation' => $candidature->getMotivation(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO candidature(motivation,date_creation)
                Values (:motivation,:date_creation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'motivation' => $candidature->getMotivation(),
                'date_creation' => $candidature->getdescription(),

            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "La candidature a été crée ! ";
                header('Location: ***');
            } else {
                return false;
            }
            exit();
        } else {
            echo "La candidature existe déjà existe déjà ! ";
            header('Location: ***');
            exit();
        }
    }

    public function listeCandidatures()
    {
        $sqlEvenement = 'SELECT * FROM evenement';
        $reqEvenement = $this->bdd->getBDD()->prepare($sqlEvenement);
        $reqEvenement->execute();

        return $reqEvenement->fetchAll();
    }

    public function nombreCandidature()
    {
        $sqlnombreevenement = 'SELECT COUNT(*) FROM evenement';
        $reqnombreevenement = $this->bdd->getBdd()->prepare($sqlnombreevenement);
        $reqnombreevenement->execute(array());

        return $reqnombreevenement->fetchColumn();

    }

    public function suppression(Candidature $candidature)
    {
        $sqlsuppression = 'DELETE FROM candidature WHERE id_candidature = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $candidature->getIdEvenement()
        ));
        header("Location: ***");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Candidature $candidature)
    {
        $sqlmodification = "UPDATE candidature SET motivation = :motivation, date_creation = :date_creation,id_candidature = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'motivation' => $candidature->getMotivation(),
            'titre' => $candidature->getDateCreation(),
            'id' => $candidature->getIdCandidature(),
        ));
        header("Location: ***");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}