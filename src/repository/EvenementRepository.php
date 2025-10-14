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
            'SELECT COUNT(*) FROM evenement WHERE titre_evenement = :titre'
        );
        $check->execute(['titre' => $evenement->getTitreEvenement()]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO evenement 
                    (type_evenement, titre_evenement, description_evenement, lieu_evenement, element_requis, nombre_place, date_creation_evenement, etat_evenement)
                    VALUES (:type, :titre, :description, :lieu, :element_requis, :nombre_place, :date_creation, :etat)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'type' => $evenement->getTypeEvenement(),
                'titre' => $evenement->getTitreEvenement(),
                'description' => $evenement->getDescriptionEvenement(),
                'lieu' => $evenement->getLieuEvenement(),
                'element_requis' => $evenement->getElementRequis(),
                'nombre_place' => $evenement->getNombrePlace(),
                'date_creation' => $evenement->getDateCreationEvenement(),
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

    public function modification(Evenement $evenement)
    {
        $sql = 'UPDATE evenement 
                SET type_evenement = :type, titre_evenement = :titre, description_evenement = :description, 
                    lieu_evenement = :lieu, element_requis = :element_requis, nombre_place = :nombre_place, 
                    date_creation_evenement = :date_creation, etat_evenement = :etat 
                WHERE id_evenement = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'type' => $evenement->getTypeEvenement(),
            'titre' => $evenement->getTitreEvenement(),
            'description' => $evenement->getDescriptionEvenement(),
            'lieu' => $evenement->getLieuEvenement(),
            'element_requis' => $evenement->getElementRequis(),
            'nombre_place' => $evenement->getNombrePlace(),
            'date_creation' => $evenement->getDateCreationEvenement(),
            'etat' => $evenement->getEtatEvenement(),
            'id' => $evenement->getIdEvenement()
        ]);
    }
}