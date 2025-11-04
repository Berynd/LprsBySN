<?php

class Utilisateur
{
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $role;
    private $specialite;
    private $poste;
    private $anneePromo;
    private $cv;
    private $motifPartenariat;
    private $estVerifie;
    private $refEntreprise;
    private $refFormation;

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

    public function getIdUtilisateur() { return $this->idUtilisateur; }
    public function setIdUtilisateur($idUtilisateur) { $this->idUtilisateur = $idUtilisateur; }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getMdp() { return $this->mdp; }
    public function setMdp($mdp) { $this->mdp = $mdp; }

    public function getRole() { return $this->role; }
    public function setRole($role) { $this->role = $role; }

    public function getSpecialite() { return $this->specialite; }
    public function setSpecialite($specialite) { $this->specialite = $specialite; }
    public function getPoste() { return $this->poste; }
    public function setPoste($poste) { $this->poste = $poste; }

    public function getAnneePromo() { return $this->anneePromo; }
    public function setAnneePromo($anneePromo) { $this->anneePromo = $anneePromo; }

    public function getCv() { return $this->cv; }
    public function setCv($cv) { $this->cv = $cv; }
    public function getMotifPartenariat() { return $this->motifPartenariat; }
    public function setMotifPartenariat($motifPartenariat) { $this->motifPartenariat = $motifPartenariat; }

    public function getEstVerifie() { return $this->estVerifie; }
    public function setEstVerifie($estVerifie) { $this->estVerifie = $estVerifie; }

    public function getRefEntreprise() { return $this->refEntreprise; }
    public function setRefEntreprise($refEntreprise) { $this->refEntreprise = $refEntreprise; }

    public function getRefFormation() { return $this->refFormation; }
    public function setRefFormation($refFormation) { $this->refFormation = $refFormation; }
}