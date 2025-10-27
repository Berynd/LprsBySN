<?php

namespace modele;
class Evenement
{
    private $idEvenement;
    private $typeEvenement;
    private $titreEvenement;
    private $descriptionEvenement;
    private $lieuEvenement;
    private $elementRequis;
    private $nombrePlace;
    private $dateEvenement;
    private $etatEvenement;

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
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * @param mixed $idEvenement
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;
    }

    /**
     * @return mixed
     */
    public function getTypeEvenement()
    {
        return $this->typeEvenement;
    }

    /**
     * @param mixed $typeEvenement
     */
    public function setTypeEvenement($typeEvenement)
    {
        $this->typeEvenement = $typeEvenement;
    }

    /**
     * @return mixed
     */
    public function getTitreEvenement()
    {
        return $this->titreEvenement;
    }

    /**
     * @param mixed $titreEvenement
     */
    public function setTitreEvenement($titreEvenement)
    {
        $this->titreEvenement = $titreEvenement;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEvenement()
    {
        return $this->descriptionEvenement;
    }

    /**
     * @param mixed $descriptionEvenement
     */
    public function setDescriptionEvenement($descriptionEvenement)
    {
        $this->descriptionEvenement = $descriptionEvenement;
    }

    /**
     * @return mixed
     */
    public function getLieuEvenement()
    {
        return $this->lieuEvenement;
    }

    /**
     * @param mixed $lieuEvenement
     */
    public function setLieuEvenement($lieuEvenement)
    {
        $this->lieuEvenement = $lieuEvenement;
    }

    /**
     * @return mixed
     */
    public function getElementRequis()
    {
        return $this->elementRequis;
    }

    /**
     * @param mixed $elementRequis
     */
    public function setElementRequis($elementRequis)
    {
        $this->elementRequis = $elementRequis;
    }

    /**
     * @return mixed
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace;
    }

    /**
     * @param mixed $nombrePlace
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace = $nombrePlace;
    }

    /**
     * @return mixed
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * @param mixed $dateEvenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;
    }

    /**
     * @return mixed
     */
    public function getEtatEvenement()
    {
        return $this->etatEvenement;
    }

    /**
     * @param mixed $etatEvenement
     */
    public function setEtatEvenement($etatEvenement)
    {
        $this->etatEvenement = $etatEvenement;
    }

}