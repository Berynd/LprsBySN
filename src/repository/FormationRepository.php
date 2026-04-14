<?php
// Repository gérant toutes les opérations en base de données liées aux formations
class FormationRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Insère une nouvelle formation (vérifie l'unicité du nom) */
    public function ajout(Formation $formation)
    {
        // Vérification que le nom de formation n'est pas déjà utilisé
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM formation WHERE nom_formation = :nom_formation'
        );
        $check->execute(['nom_formation' => $formation->getNomFormation()]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO formation (nom_formation) VALUES (:nom_formation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom_formation' => $formation->getNomFormation()
            ]);
        }

        // Formation déjà existante : retourne false
        return false;
    }

    /** Retourne le détail d'une formation par son identifiant */
    public function detailFormation($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM formation WHERE id_formation = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Retourne la liste de toutes les formations */
    public function listeFormation()
    {
        $sql = 'SELECT * FROM formation';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Retourne le nombre total de formations */
    public function nombreFormation()
    {
        $sql = 'SELECT COUNT(*) FROM formation';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    /** Supprime une formation par son identifiant */
    public function suppression(Formation $formation)
    {
        $sql = 'DELETE FROM formation WHERE id_formation = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $formation->getIdFormation()]);
    }

    /** Met à jour le nom d'une formation */
    public function modification(Formation $formation)
    {
        $sql = 'UPDATE formation SET nom_formation = :nom_formation WHERE id_formation = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom_formation' => $formation->getNomFormation(),
            'id'            => $formation->getIdFormation()
        ]);
    }
}
