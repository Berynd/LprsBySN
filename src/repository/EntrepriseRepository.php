<?php
// Repository gérant toutes les opérations en base de données liées aux entreprises
class EntrepriseRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Insère une nouvelle entreprise (vérifie l'unicité du nom) */
    public function ajout(Entreprise $entreprise)
    {
        // Vérification que le nom n'est pas déjà utilisé
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM entreprise WHERE nom = :nom'
        );
        $check->execute(['nom' => $entreprise->getNom()]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO entreprise (nom, adresse, site_web) VALUES (:nom, :adresse, :site_web)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom'      => $entreprise->getNom(),
                'adresse'  => $entreprise->getAdresse(),
                'site_web' => $entreprise->getSiteWeb()
            ]);
        }

        // Entreprise déjà existante : retourne false
        return false;
    }

    /** Retourne le détail d'une entreprise par son identifiant */
    public function detailEntreprise($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM entreprise WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Retourne la liste de toutes les entreprises */
    public function listeEntreprise()
    {
        $sql = 'SELECT * FROM entreprise';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Retourne le nombre total d'entreprises */
    public function nombreEntreprise()
    {
        $sql = 'SELECT COUNT(*) FROM entreprise';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    /** Supprime une entreprise par son identifiant */
    public function suppression(Entreprise $entreprise)
    {
        $sql = 'DELETE FROM entreprise WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $entreprise->getIdEntreprise()]);
    }

    /** Met à jour les informations d'une entreprise */
    public function modification(Entreprise $entreprise)
    {
        $sql = 'UPDATE entreprise
                SET nom = :nom, adresse = :adresse, site_web = :site_web
                WHERE id_entreprise = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom'      => $entreprise->getNom(),
            'adresse'  => $entreprise->getAdresse(),
            'site_web' => $entreprise->getSiteWeb(),
            'id'       => $entreprise->getIdEntreprise()
        ]);
    }
}
