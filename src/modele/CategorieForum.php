<?php

class CategorieForum
{
    private $idCategorieForum;
    private $nomCategorieForum;
    private $descriptionCategorieForum;
    private $categorie;

    public function getIdCategorieForum()
    {
        return $this->idCategorieForum;
    }

    public function setIdCategorieForum($idCategorieForum)
    {
        $this->idCategorieForum = $idCategorieForum;
    }

    public function getNomCategorieForum()
    {
        return $this->nomCategorieForum;
    }

    public function setNomCategorieForum($nomCategorieForum)
    {
        $this->nomCategorieForum = $nomCategorieForum;
    }

    public function getDescriptionCategorieForum()
    {
        return $this->descriptionCategorieForum;
    }

    public function setDescriptionCategorieForum($descriptionCategorieForum)
    {
        $this->descriptionCategorieForum = $descriptionCategorieForum;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}