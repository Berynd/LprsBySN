<?php
class EvenementRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Evenement $evenement)
    {
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
                'type' => $evenement->getTypeEvenement(),
                'titre' => $evenement->getTitreEvenement(),
                'description' => $evenement->getDescriptionEvenement(),
                'lieu' => $evenement->getLieuEvenement(),
                'element_requis' => $evenement->getElementRequis(),
                'nombre_place' => $evenement->getNombrePlace(),
                'date_evenement' => $evenement->getDateEvenement(),
                'etat' => $evenement->getEtatEvenement()
            ]);
        }

        return false;
    }

    public function listeEvenement()
    {
        $sql = 'SELECT * FROM evenement';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listeEvenementuser() {
        $sql = "SELECT * FROM evenement WHERE etat = 1";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function nombreEvenement()
    {
        $sql = 'SELECT COUNT(*) FROM evenement';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    public function suppression(Evenement $evenement)
    {
        $sql = 'DELETE FROM evenement WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $evenement->getIdEvenement()]);
    }

    public function detailEvenement($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM evenement WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function modification(Evenement $evenement)
    {
        $sql = 'UPDATE evenement SET type = :type, titre = :titre, description = :description, lieu = :lieu, element_requis = :element_requis, nombre_place = :nombre_place, date_evenement = :date_evenement, etat = :etat WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'type' => $evenement->getTypeEvenement(),
            'titre' => $evenement->getTitreEvenement(),
            'description' => $evenement->getDescriptionEvenement(),
            'lieu' => $evenement->getLieuEvenement(),
            'element_requis' => $evenement->getElementRequis(),
            'nombre_place' => $evenement->getNombrePlace(),
            'date_evenement' => $evenement->getDateEvenement(),
            'etat' => $evenement->getEtatEvenement(),
            'id' => $evenement->getIdEvenement()
        ]);
    }
}