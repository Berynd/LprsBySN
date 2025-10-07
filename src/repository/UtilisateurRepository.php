<?php


class UtilisateurRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Détail d’un utilisateur */
    public function detailUtilisateur($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM utilisateur WHERE id_utilisateur = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Inscription depuis le site public */
    public function inscription(Utilisateur $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO Utilisateur(nom,prenom,email,mdp) 
                Values (:nom,:prenom,:email,:mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "Votre profil a été créé ! ";
                header('Location:../../vue/Connexion.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Vous avez déjà un compte, veuillez vous connecter ! ";
            header('Location: ../../index.php');
            exit();
        }
    }

    /** Ajout d’un utilisateur par un administrateur */
    public function ajout(Utilisateur $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(['email' => $user->getEmail()]);
        $donne = $req2->fetch();

        if ($donne === false) {
            $sql = 'INSERT INTO utilisateur
                    (nom, prenom, email, mdp, role, specialite, matiere, poste, annee_promo, cv, promo, motif_partenariat, est_verifie, ref_entreprise, ref_formation)
                    VALUES
                    (:nom, :prenom, :email, :mdp, :role, :specialite, :matiere, :poste, :annee_promo, :cv, :promo, :motif_partenariat, :est_verifie, :ref_entreprise, :ref_formation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
                'role' => $user->getRole(),
                'specialite' => $user->getSpecialite(),
                'matiere' => $user->getMatiere(),
                'poste' => $user->getPoste(),
                'annee_promo' => $user->getAnneePromo(),
                'cv' => $user->getCv(),
                'promo' => $user->getPromo(),
                'motif_partenariat' => $user->getMotifPartenariat(),
                'est_verifie' => $user->getEstVerifie(),
                'ref_entreprise' => $user->getRefEntreprise(),
                'ref_formation' => $user->getRefFormation()
            ]);
        }

        return false;
    }

    /** Connexion utilisateur */
    public function connexion(Utilisateur $user)
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['email' => $user->getEmail()]);
        $donne = $req->fetch(PDO::FETCH_ASSOC);

        if ($donne && $user->getMdp() === $donne['mdp']) {
            $user->setIdUtilisateur($donne['id_utilisateur']);
            $user->setNom($donne['nom']);
            $user->setPrenom($donne['prenom']);
            $user->setEmail($donne['email']);
            $user->setRole($donne['role']);
            return $user;
        }

        return null;
    }

    /** Liste des utilisateurs */
    public function listeUtilisateur()
    {
        $sql = 'SELECT * FROM utilisateur';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Modification côté admin */
    public function modificationAdmin(Utilisateur $user)
    {
        $sql = "UPDATE utilisateur SET 
                    nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, 
                    role = :role, specialite = :specialite, matiere = :matiere, 
                    poste = :poste, annee_promo = :annee_promo, cv = :cv, 
                    promo = :promo, motif_partenariat = :motif_partenariat, 
                    est_verifie = :est_verifie 
                WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'mdp' => $user->getMdp(),
            'role' => $user->getRole(),
            'specialite' => $user->getSpecialite(),
            'matiere' => $user->getMatiere(),
            'poste' => $user->getPoste(),
            'annee_promo' => $user->getAnneePromo(),
            'cv' => $user->getCv(),
            'promo' => $user->getPromo(),
            'motif_partenariat' => $user->getMotifPartenariat(),
            'est_verifie' => $user->getEstVerifie(),
            'id' => $user->getIdUtilisateur()
        ]);
    }

    /** Modification côté utilisateur */
    public function modificationUtilisateur(Utilisateur $user)
    {
        $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'mdp' => $user->getMdp(),
            'id' => $user->getIdUtilisateur()
        ]);
    }

    /** Suppression */
    public function suppression(Utilisateur $user)
    {
        $sql = 'DELETE FROM utilisateur WHERE id_utilisateur = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $user->getIdUtilisateur()]);
    }

    /** Compte le nombre total d’utilisateurs */
    public function nombreUtilisateur()
    {
        $sql = 'SELECT COUNT(*) FROM utilisateur';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }
}