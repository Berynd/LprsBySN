<?php

class ReponseForum
{
    private $idReponseForum;
    private $contenuReponseForum;
    private $dateCreationReponseForum;
    private $refPostForum;
    private $refUtilisateur;

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