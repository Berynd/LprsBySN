<?php

class CategorieForum
{
    private $idCategorieForum;
    private $nomCategorieForum;
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
        return $this->nomCategorieForum;
    }

    /**
     * @param mixed $nomCategorieForum
     */
    public function setNomCategorieForum($nomCategorieForum)
    {
        $this->nomCategorieForum = $nomCategorieForum;
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