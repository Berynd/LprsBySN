<?php

class ReponseForum
{
    private $idReponseForum;
    private $contenuReponseForum;
    private $dateCreationReponseForum;
    private $refCategorieForum;
    private $refPostForum;
    private $refUtilisateur;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {

            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {

                $this->$method($value);
            }
        }
    }

    public function getIdReponseForum()
    {
        return $this->idReponseForum;
    }

    public function setIdReponseForum($idReponseForum)
    {
        $this->idReponseForum = $idReponseForum;
    }

    public function getContenuReponseForum()
    {
        return $this->contenuReponseForum;
    }

    public function setContenuReponseForum($contenuReponseForum)
    {
        $this->contenuReponseForum = $contenuReponseForum;
    }

    public function getDateCreationReponseForum()
    {
        return $this->dateCreationReponseForum;
    }

    public function setDateCreationReponseForum($dateCreationReponseForum)
    {
        $this->dateCreationReponseForum = $dateCreationReponseForum;
    }

    public function getRefCategorieForum()
    {
        return $this->refCategorieForum;
    }

    public function setRefCategorieForum($refCategorieForum)
    {
        $this->refCategorieForum = $refCategorieForum;
    }

    public function getRefPostForum()
    {
        return $this->refPostForum;
    }

    public function setRefPostForum($refPostForum)
    {
        $this->refPostForum = $refPostForum;
    }

    public function getRefUtilisateur()
    {
        return $this->refUtilisateur;
    }

    public function setRefUtilisateur($refUtilisateur)
    {
        $this->refUtilisateur = $refUtilisateur;
    }
}