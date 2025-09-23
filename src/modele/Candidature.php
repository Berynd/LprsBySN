<?php

class Candidature
{
    /**
     * @return mixed
     */
    public function getIdCandidature()
    {
        return $this->idCandidature;
    }

    /**
     * @param mixed $idCandidature
     */
    public function setIdCandidature($idCandidature)
    {
        $this->idCandidature = $idCandidature;
    }

    /**
     * @return mixed
     */
    public function getMotivation()
    {
        return $this->motivation;
    }

    /**
     * @param mixed $motivation
     */
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;
    }

    /**
     * @return mixed
     */
    public function getDateCandidature()
    {
        return $this->dateCandidature;
    }

    /**
     * @param mixed $dateCandidature
     */
    public function setDateCandidature($dateCandidature)
    {
        $this->dateCandidature = $dateCandidature;
    }

    /**
     * @return mixed
     */
    public function getRefOffre()
    {
        return $this->refOffre;
    }

    /**
     * @param mixed $refOffre
     */
    public function setRefOffre($refOffre)
    {
        $this->refOffre = $refOffre;
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
private $idCandidature;
private $motivation;
private $dateCandidature;
private $refOffre;
private $refUtilisateur;
}