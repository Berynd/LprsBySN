<?php

class ReponseForum
{
private $idReponseForum;
private $contenuReponseForum;
private $dateCreationReponseForum;
private $refPostForum;
private $refPost;
private $refUtilisateur;

    /**
     * @return mixed
     */
    public function getIdReponseForum()
    {
        return $this->idReponseForum;
    }

    /**
     * @param mixed $idReponseForum
     */
    public function setIdReponseForum($idReponseForum)
    {
        $this->idReponseForum = $idReponseForum;
    }

    /**
     * @return mixed
     */
    public function getContenuReponseForum()
    {
        return $this->contenuReponseForum;
    }

    /**
     * @param mixed $contenuReponseForum
     */
    public function setContenuReponseForum($contenuReponseForum)
    {
        $this->contenuReponseForum = $contenuReponseForum;
    }

    /**
     * @return mixed
     */
    public function getDateCreationReponseForum()
    {
        return $this->dateCreationReponseForum;
    }

    /**
     * @param mixed $dateCreationReponseForum
     */
    public function setDateCreationReponseForum($dateCreationReponseForum)
    {
        $this->dateCreationReponseForum = $dateCreationReponseForum;
    }

    /**
     * @return mixed
     */
    public function getRefPostForum()
    {
        return $this->refPostForum;
    }

    /**
     * @param mixed $refPostForum
     */
    public function setRefPostForum($refPostForum)
    {
        $this->refPostForum = $refPostForum;
    }

    /**
     * @return mixed
     */
    public function getRefPost()
    {
        return $this->refPost;
    }

    /**
     * @param mixed $refPost
     */
    public function setRefPost($refPost)
    {
        $this->refPost = $refPost;
    }

    /**
     * @return mixed
     */
    public function getRefUtilisateur()
    {
        return $this->refUtilisateur;
    }

    /**
     * @param mixed $refUtilisateur
     */
    public function setRefUtilisateur($refUtilisateur)
    {
        $this->refUtilisateur = $refUtilisateur;
    }
}