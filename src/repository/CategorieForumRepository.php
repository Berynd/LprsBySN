<?php

namespace repository;

class CategorieForumRepository
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(CategorieForum $categorieForum)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM categorie_forum WHERE nom = :nom');
        $req2->execute(array(
            'nom' => $categorieForum->getNom(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO categorie_forum(nom,description,categorie) 
                Values (:nom,:description,:categorie)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $categorieForum->getNom(),
                'description' => $categorieForum->getDescription(),
                'categorie' => $categorieForum->getCategorie(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "La categorie a été crée ! ";
                header('Location: ***');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Cette categorie existe déjà ! ";
            header('Location: ***');
            exit();
        }
    }

    public function listeCategorie()
    {
        $sqlCategorieForum = 'SELECT * FROM categorie_forum';
        $reqCategorieForum = $this->bdd->getBDD()->prepare($sqlCategorieForum);
        $reqCategorieForum->execute();

        return $reqCategorieForum->fetchAll();
    }

    public function nombreCategorieForum()
    {
        $sqlnombrecategorieforum = 'SELECT COUNT(*) FROM categorie_forum';
        $reqnombrecategorieforum = $this->bdd->getBdd()->prepare($sqlnombrecategorieforum);
        $reqnombrecategorieforum->execute(array());

        return $reqnombrecategorieforum->fetchColumn();

    }

    public function suppression(CategorieForum $categorieForum)
    {
        $sqlsuppression = 'DELETE FROM categorie_forum WHERE id_categorie_forum = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $categorieForum->getIdEntreprise()
        ));
        header("Location: ***");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(CategorieForum $categorieForum)
    {
        $sqlmodification = "UPDATE categorie_forum SET nom = :nom, description = :description, categorie = :categorie WHERE id_categorie_forum = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $categorieForum->getNom(),
            'description' => $categorieForum->getDescription(),
            'categorie' => $categorieForum->getCategorie(),
            'id' => $categorieForum->getIdCategorieForum()
        ));
        header("Location: ***");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}