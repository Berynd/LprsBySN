<?php

namespace repository;
require_once __DIR__ . '/../bdd/BDD.php';
require_once __DIR__ . '/../modele/CategorieForum.php';

use modele\CategorieForum;

class CategorieForumRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \BDD();
    }

    public function ajout(CategorieForum $categorieForum)
    {
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM categorie_forum WHERE nom = :nom'
        );
        $check->execute([
            'nom' => $categorieForum->getNomCategorieForum()
        ]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO categorie_forum (nom, description, categorie)
                    VALUES (:nom, :description, :categorie)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom' => $categorieForum->getNomCategorieForum(),
                'description' => $categorieForum->getDescriptionCategorieForum(),
                'categorie' => $categorieForum->getCategorie()
            ]);
        }

        return false; // existe déjà
    }

    public function listeCategorie()
    {
        $sql = 'SELECT * FROM categorie_forum';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function nombreCategorieForum()
    {
        $sql = 'SELECT COUNT(*) FROM categorie_forum';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    public function suppression(CategorieForum $categorieForum)
    {
        $sql = 'DELETE FROM categorie_forum WHERE id_categorie_forum = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $categorieForum->getIdCategorieForum()]);
    }

    public function modification(CategorieForum $categorieForum)
    {
        $sql = 'UPDATE categorie_forum 
                SET nom = :nom, description = :description, categorie = :categorie 
                WHERE id_categorie_forum = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom' => $categorieForum->getNomCategorieForum(),
            'description' => $categorieForum->getDescriptionCategorieForum(),
            'categorie' => $categorieForum->getCategorie(),
            'id' => $categorieForum->getIdCategorieForum()
        ]);
    }
}