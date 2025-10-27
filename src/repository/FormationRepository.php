<?php

class FormationRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Formation $formation)
    {


        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM formation WHERE nom_formation = :nom_formation'
        );
        $check->execute([
            'nom_formation' => $formation->getNomFormation()
        ]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO formation (nom_formation)
                    VALUES (:nom_formation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom_formation' => $formation->getNomFormation()
            ]);
        }

        return false; // formation déjà existante
    }

    public function listeFormation()
    {
        $sql = 'SELECT * FROM formation';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function nombreFormation()
    {
        $sql = 'SELECT COUNT(*) FROM formation';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    public function suppression(Formation $formation)
    {
        $sql = 'DELETE FROM formation WHERE id_formation = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $formation->getIdFormation()]);
    }

    public function modification(Formation $formation)
    {
        $sql = 'UPDATE formation 
                SET nom_formation = :nom_formation 
                WHERE id_formation = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom_formation' => $formation->getNomFormation(),
            'id' => $formation->getIdFormation()
        ]);
    }
}