<?php

namespace repository;

use Offre;

class OffreRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function ajoutOffres(Offre $offre)
    {
        $sql = "INSERT INTO offre (titre, description, mission, salaire,type_offre,date_creation,etat)VALUES (:titre,:description,:mission,:salaire,:type,:date_creation,:etat)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'titre' => $offre->getTitre(),
            'description' => $offre->getDescription(),
            'mission' => $offre->getMission(),
            'salaire' => $offre->getSalaire(),
            'type_offre' => $offre->getTypeOffre(),
            'date_creation' => $offre->getDateCreation(),
            'etat' => $offre->getEtat()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

    public function supOffres(Offre $offre)
    {
        $sql = "DELETE FROM offre WHERE id = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute([
                "id" => $offre->getIdOffre()
            ]
        );
    }


    public function catalogueOffres()
    {
        $sql = "SELECT * FROM offre";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau de films

    }

    public function modifOffres(Offre $offre)
    {
        $sql = 'UPDATE offre SET titre=:titre,description=:description,mission=:mission,salaire=:salaire,type_offre,date_creation=:date_creation,etat=:etat WHERE id_offre = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(array(
            'titre' => $offre->getTitre(),
            'description' => $offre->getDescription(),
            'mission' => $offre->getmission(),
            'salaire' => $offre->getsalaire(),
            'type_offre' => $offre->getTypeOffre(),
            'date_creation' => $offre->getDateCreation(),
            'etat' => $offre->getEtat(),
            'id' => $offre->getIdOffre()
        ));



    }
}