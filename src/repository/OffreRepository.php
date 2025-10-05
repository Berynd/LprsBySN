<?php

namespace repository;

use modele\Offre;
use BDD;
use PDO;

class OffreRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Offre $offre)
    {
        $sql = "INSERT INTO offre 
                (titre, description, mission, salaire, type_offre, date_creation_offre, etat_offre, ref_entreprise)
                VALUES (:titre, :description, :mission, :salaire, :type_offre, :date_creation, :etat, :ref_entreprise)";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'titre' => $offre->getTitre(),
            'description' => $offre->getDescription(),
            'mission' => $offre->getMission(),
            'salaire' => $offre->getSalaire(),
            'type_offre' => $offre->getTypeOffre(),
            'date_creation' => $offre->getDateCreation(),
            'etat' => $offre->getEtatOffre(),
            'ref_entreprise' => $offre->getRefEntreprise()
        ]);
    }

    public function suppression(Offre $offre)
    {
        $sql = "DELETE FROM offre WHERE id_offre = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $offre->getIdOffre()]);
    }

    public function listeOffres()
    {
        $sql = "SELECT * FROM offre";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modification(Offre $offre)
    {
        $sql = 'UPDATE offre 
                SET titre = :titre, 
                    description = :description, 
                    mission = :mission, 
                    salaire = :salaire, 
                    type_offre = :type_offre, 
                    date_creation_offre = :date_creation, 
                    etat_offre = :etat, 
                    ref_entreprise = :ref_entreprise
                WHERE id_offre = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'titre' => $offre->getTitre(),
            'description' => $offre->getDescription(),
            'mission' => $offre->getMission(),
            'salaire' => $offre->getSalaire(),
            'type_offre' => $offre->getTypeOffre(),
            'date_creation' => $offre->getDateCreation(),
            'etat' => $offre->getEtatOffre(),
            'ref_entreprise' => $offre->getRefEntreprise(),
            'id' => $offre->getIdOffre()
        ]);
    }
}