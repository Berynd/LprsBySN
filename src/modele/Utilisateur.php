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
    private $matiere;
    private $post;
    private $anneePromo;
    private $cv;
    private $promo;
    private $motifPartenariat;
    private $estVerifie;
    private $refEntreprise;
    private $refFormation;

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @param mixed $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param mixed $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getAnneePromo()
    {
        return $this->anneePromo;
    }

    /**
     * @param mixed $anneePromo
     */
    public function setAnneePromo($anneePromo)
    {
        $this->anneePromo = $anneePromo;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     * @return mixed
     */
    public function getMotifPartenariat()
    {
        return $this->motifPartenariat;
    }

    /**
     * @param mixed $motifPartenariat
     */
    public function setMotifPartenariat($motifPartenariat)
    {
        $this->motifPartenariat = $motifPartenariat;
    }

    /**
     * @return mixed
     */
    public function getEstVerifie()
    {
        return $this->estVerifie;
    }

    /**
     * @param mixed $estVerifie
     */
    public function setEstVerifie($estVerifie)
    {
        $this->estVerifie = $estVerifie;
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

    /**
     * @return mixed
     */
    public function getRefFormation()
    {
        return $this->refFormation;
    }

    /**
     * @param mixed $refFormation
     */
    public function setRefFormation($refFormation)
    {
        $this->refFormation = $refFormation;
    }
}