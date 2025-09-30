<?php

namespace repository;

class FormationRepository
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Formation $formation)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM entreprise WHERE nom_formation = :nom_formation');
        $req2->execute(array(
            'nom_formation' => $formation->getNomFormation(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO formation(nom_formation) 
                Values (:nom_formation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom_formation' => $formation->getNomFormation()
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "La formation a été crée ! ";
                header('Location: ***');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Cette formation existe déjà ! ";
            header('Location: ***');
            exit();
        }
    }

    public function listeFormation()
    {
        $sqlFormation = 'SELECT * FROM formation';
        $reqFormation = $this->bdd->getBDD()->prepare($sqlFormation);
        $reqFormation->execute();

        return $reqFormation->fetchAll();
    }

    public function nombreFormation()
    {
        $sqlnombreformation = 'SELECT COUNT(*) FROM formation';
        $reqnombreformation = $this->bdd->getBdd()->prepare($sqlnombreformation);
        $reqnombreformation->execute(array());

        return $reqnombreformation->fetchColumn();

    }

    public function suppression(Formation $formation)
    {
        $sqlsuppression = 'DELETE FROM formation WHERE id_formation = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $formation->getIdFormation()
        ));
        header("Location: ***");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Formation $formation)
    {
        $sqlmodification = "UPDATE formation SET nom_formation = :nom_formation WHERE id_formation = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom_formation' => $formation->getNomFormation(),
            'id' => $formation->getIdFormation()
        ));
        header("Location: ***");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}