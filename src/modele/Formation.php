<?php

class Formation
{
    private $idFormation;
    private $nomFormation;

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