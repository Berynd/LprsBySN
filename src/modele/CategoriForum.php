<?php

class CategoriForum
{
private $idCategorieForum;
private $NomCategorieForum;
private $descriptionCategorieForum;
private $categorieForum;

    /**
     * @return mixed
     */
    public function getIdCategorieForum()
    {
        return $this->idCategorieForum;
    }

    /**
     * @param mixed $idCategorieForum
     */
    public function setIdCategorieForum($idCategorieForum)
    {
        $this->idCategorieForum = $idCategorieForum;
    }

    /**
     * @return mixed
     */
    public function getNomCategorieForum()
    {
        return $this->NomCategorieForum;
    }

    /**
     * @param mixed $NomCategorieForum
     */
    public function setNomCategorieForum($NomCategorieForum)
    {
        $this->NomCategorieForum = $NomCategorieForum;
    }

    /**
     * @return mixed
     */
    public function getDescriptionCategorieForum()
    {
        return $this->descriptionCategorieForum;
    }

    /**
     * @param mixed $descriptionCategorieForum
     */
    public function setDescriptionCategorieForum($descriptionCategorieForum)
    {
        $this->descriptionCategorieForum = $descriptionCategorieForum;
    }

    /**
     * @return mixed
     */
    public function getCategorieForum()
    {
        return $this->categorieForum;
    }

    /**
     * @param mixed $categorieForum
     */
    public function setCategorieForum($categorieForum)
    {
        $this->categorieForum = $categorieForum;
    }
}