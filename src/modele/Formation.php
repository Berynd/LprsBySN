<?php

class Formation
{
    private $idFormation;
    private $nomFormation;

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
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * @param mixed $idFormation
     */
    public function setIdFormation($idFormation)
    {
        $this->idFormation = $idFormation;
    }

    /**
     * @return mixed
     */
    public function getNomFormation()
    {
        return $this->nomFormation;
    }

    /**
     * @param mixed $nomFormation
     */
    public function setNomFormation($nomFormation)
    {
        $this->nomFormation = $nomFormation;
    }
}