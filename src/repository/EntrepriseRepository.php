<?php

namespace repository;

class EntrepriseRepository
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(Entreprise $entreprise)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM entreprise WHERE nom = :nom');
        $req2->execute(array(
            'nom' => $entreprise->getNom(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO entreprise(nom,adresse,site_web) 
                Values (:nom,:adresse,:site_web)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $entreprise->getNom(),
                'adresse' => $entreprise->getAdresse(),
                'site_web' => $entreprise->getSiteWeb(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "L'entreprise a été crée ! ";
                header('Location: ***');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Cet entreprise existe déjà ! ";
            header('Location: ***');
            exit();
        }
    }

    public function listeEntreprise()
    {
        $sqlEntreprise = 'SELECT * FROM entreprise';
        $reqEntreprise = $this->bdd->getBDD()->prepare($sqlEntreprise);
        $reqEntreprise->execute();

        return $reqEntreprise->fetchAll();
    }

    public function nombreEntreprise()
    {
        $sqlnombreentreprise = 'SELECT COUNT(*) FROM entreprise';
        $reqnombreentreprise = $this->bdd->getBdd()->prepare($sqlnombreentreprise);
        $reqnombreentreprise->execute(array());

        return $reqnombreentreprise->fetchColumn();

    }

    public function suppression(Entreprise $entreprise)
    {
        $sqlsuppression = 'DELETE FROM entreprise WHERE id_entreprise = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $entreprise->getIdEntreprise()
        ));
        header("Location: ***");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Entreprise $entreprise)
    {
        $sqlmodification = "UPDATE entreprise SET nom = :nom, adresse = :adresse, site_web = :site_web WHERE id_entreprise = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $entreprise->getNom(),
            'adresse' => $entreprise->getAdresse(),
            'site_web' => $entreprise->getSiteWeb(),
            'id' => $entreprise->getIdEntreprise()
        ));
        header("Location: ***");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}