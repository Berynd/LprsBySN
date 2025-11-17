<?php
namespace modele;
class CategorieForum
{
    private $idCategorieForum;
    private $nom;
    private $description;
    private $categorie;

    public function __construct(array $donnees = [])
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
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

    public function getIdCategorieForum()
    {
        return $this->idCategorieForum;
    }

    public function setIdCategorieForum($idCategorieForum)
    {
        $this->idCategorieForum = $idCategorieForum;
    }

    public function getNomCategorieForum()
    {
        return $this->nom;
    }

    public function setNomCategorieForum($nom)
    {
        $this->nom = $nom;
    }

    public function getDescriptionCategorieForum()
    {
        return $this->description;
    }

    public function setDescriptionCategorieForum($description)
    {
        $this->description = $description;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}