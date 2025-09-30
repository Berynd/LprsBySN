<?php

namespace repository;

class CandidatureRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }
    public function ajout(Candidature $candidature)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM candidature WHERE email = :email');
        $req2->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO utilisateur(nom,prenom,email,mdp,role,specialite,matiere,poste,annee) 
                Values (:nom,:prenom,:email,:mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
            ));
}