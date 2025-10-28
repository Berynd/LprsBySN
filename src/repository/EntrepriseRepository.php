<?php

class EntrepriseRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Entreprise $entreprise)
    {
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM entreprise WHERE nom = :nom'
        );
        $check->execute([
            'nom' => $entreprise->getNom()
        ]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO entreprise (nom, adresse, site_web)
                    VALUES (:nom, :adresse, :site_web)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom' => $entreprise->getNom(),
                'adresse' => $entreprise->getAdresse(),
                'site_web' => $entreprise->getSiteWeb()
            ]);
        }

        return false; // entreprise déjà existante
    }

    public function detailEntreprise($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM entreprise WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function listeEntreprise()
    {
        $sql = 'SELECT * FROM entreprise';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function nombreEntreprise()
    {
        $sql = 'SELECT COUNT(*) FROM entreprise';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    public function suppression(Entreprise $entreprise)
    {
        $sql = 'DELETE FROM entreprise WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $entreprise->getIdEntreprise()]);
    }

    public function modification(Entreprise $entreprise)
    {
        $sql = 'UPDATE entreprise 
                SET nom = :nom, adresse = :adresse, site_web = :site_web 
                WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom' => $entreprise->getNom(),
            'adresse' => $entreprise->getAdresse(),
            'site_web' => $entreprise->getSiteWeb(),
            'id' => $entreprise->getIdEntreprise()
        ]);
    }
}