<?php

class Offre
{
    private $idOffre;
    private $titre;
    private $description;
    private $mission;
    private $salaire;
    private $typeOffre;
    private $dateCreation;
    private $etatOffre;
    private $refEntreprise;

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

    /**
     * @return mixed
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * @param mixed $idOffre
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @param mixed $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    /**
     * @return mixed
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * @param mixed $salaire
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;
    }

    /**
     * @return mixed
     */
    public function getTypeOffre()
    {
        return $this->typeOffre;
    }

    /**
     * @param mixed $typeOffre
     */
    public function setTypeOffre($typeOffre)
    {
        $this->typeOffre = $typeOffre;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getEtatOffre()
    {
        return $this->etatOffre;
    }

    /**
     * @param mixed $etatOffre
     */
    public function setEtatOffre($etatOffre)
    {
        $this->etatOffre = $etatOffre;
    }

    /**
     * @return mixed
     */
    public function getRefEntreprise()
    {
        return $this->refEntreprise;
    }

    /**
     * @param mixed $refEntreprise
     */
    public function setRefEntreprise($refEntreprise)
    {
        $this->refEntreprise = $refEntreprise;
    }
}