<?php

namespace repository;

use modele\Candidature;
use BDD;

class CandidatureRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Candidature $candidature)
    {
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM candidature WHERE motivation = :motivation AND ref_utilisateur = :refUtilisateur AND ref_offre = :refOffre'
        );
        $check->execute([
            'motivation' => $candidature->getMotivation(),
            'refUtilisateur' => $candidature->getRefUtilisateur(),
            'refOffre' => $candidature->getRefOffre()
        ]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO candidature (motivation, date_candidature, ref_offre, ref_utilisateur)
                    VALUES (:motivation, :date_candidature, :ref_offre, :ref_utilisateur)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'motivation' => $candidature->getMotivation(),
                'date_candidature' => $candidature->getDateCandidature(),
                'ref_offre' => $candidature->getRefOffre(),
                'ref_utilisateur' => $candidature->getRefUtilisateur()
            ]);
        }

        return false;
    }

    public function listeCandidatures()
    {
        $sql = 'SELECT * FROM candidature';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function nombreCandidature()
    {
        $sql = 'SELECT COUNT(*) FROM candidature';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    public function suppression(Candidature $candidature)
    {
        $sql = 'DELETE FROM candidature WHERE id_candidature = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $candidature->getIdCandidature()]);
    }

    public function modification(Candidature $candidature)
    {
        $sql = "UPDATE candidature 
                SET motivation = :motivation, date_candidature = :date_candidature 
                WHERE id_candidature = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'motivation' => $candidature->getMotivation(),
            'date_candidature' => $candidature->getDateCandidature(),
            'id' => $candidature->getIdCandidature()
        ]);
    }
}