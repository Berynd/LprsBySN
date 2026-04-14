<?php
// Repository gérant toutes les opérations en base de données liées aux événements
class EvenementRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Insère un nouvel événement (vérifie l'unicité du titre) */
    public function ajout(Evenement $evenement)
    {
        // Vérification de l'unicité du titre
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM evenement WHERE titre = :titre'
        );
        $check->execute(['titre' => $evenement->getTitreEvenement()]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO evenement
                    (type, titre, description, lieu, element_requis, nombre_place, date_evenement, etat)
                    VALUES (:type, :titre, :description, :lieu, :element_requis, :nombre_place, :date_evenement, :etat)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'type'            => $evenement->getTypeEvenement(),
                'titre'           => $evenement->getTitreEvenement(),
                'description'     => $evenement->getDescriptionEvenement(),
                'lieu'            => $evenement->getLieuEvenement(),
                'element_requis'  => $evenement->getElementRequis(),
                'nombre_place'    => $evenement->getNombrePlace(),
                'date_evenement'  => $evenement->getDateEvenement(),
                'etat'            => $evenement->getEtatEvenement()
            ]);
        }

        // Titre déjà existant : retourne false
        return false;
    }

    /** Retourne tous les événements (vue admin) */
    public function listeEvenement()
    {
        $sql = 'SELECT * FROM evenement';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Retourne uniquement les événements validés (vue utilisateur public) */
    public function listeEvenementuser()
    {
        $sql = "SELECT * FROM evenement WHERE validation = 1";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Retourne le nombre total d'événements */
    public function nombreEvenement()
    {
        $sql = 'SELECT COUNT(*) FROM evenement';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    /** Supprime un événement par son identifiant */
    public function suppression(Evenement $evenement)
    {
        $sql = 'DELETE FROM evenement WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $evenement->getIdEvenement()]);
    }

    /** Retourne le détail d'un événement par son identifiant */
    public function detailEvenement($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM evenement WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Met à jour tous les champs d'un événement */
    public function modification(Evenement $evenement)
    {
        $sql = 'UPDATE evenement
                SET type = :type, titre = :titre, description = :description, lieu = :lieu,
                    element_requis = :element_requis, nombre_place = :nombre_place,
                    date_evenement = :date_evenement, etat = :etat
                WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'type'           => $evenement->getTypeEvenement(),
            'titre'          => $evenement->getTitreEvenement(),
            'description'    => $evenement->getDescriptionEvenement(),
            'lieu'           => $evenement->getLieuEvenement(),
            'element_requis' => $evenement->getElementRequis(),
            'nombre_place'   => $evenement->getNombrePlace(),
            'date_evenement' => $evenement->getDateEvenement(),
            'etat'           => $evenement->getEtatEvenement(),
            'id'             => $evenement->getIdEvenement()
        ]);
    }

    /** Valide un événement pour le rendre visible aux utilisateurs (validation = 1) */
    public function validationEvenement(Evenement $evenement)
    {
        $sql = "UPDATE evenement SET validation = :validation WHERE id_evenement = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'validation' => 1,
            'id'         => $evenement->getIdEvenement()
        ]);
    }
}
