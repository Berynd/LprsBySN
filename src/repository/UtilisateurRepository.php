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
                    (nom, prenom, email, mdp, role, specialite, poste, annee_promo, cv, motif_partenariat, est_verifie, ref_entreprise, ref_formation)
                    VALUES
                    (:nom, :prenom, :email, :mdp, :role, :specialite, :poste, :annee_promo, :cv, :motif_partenariat, :est_verifie, :ref_entreprise, :ref_formation)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
                'role' => $user->getRole(),
                'specialite' => $user->getSpecialite(),
                'poste' => $user->getPoste(),
                'annee_promo' => $user->getAnneePromo(),
                'cv' => $user->getCv(),
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
        $sqlconnexion = 'SELECT * FROM utilisateur WHERE email = :email';
        $reqconnexion = $this->bdd->getBdd()->prepare($sqlconnexion);
        $reqconnexion->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $reqconnexion->fetch();
        if($donne && password_verify($user->getMdp(), $donne['mdp'])) {
            $user->setNom($donne['nom']);
            $user->setPrenom($donne['prenom']);
            $user->setEmail($donne['email']);
            $user->setMdp($donne['mdp']);
            $user->setRole($donne['role']);
            $user->setIdUtilisateur($donne['id_utilisateur']);

            return $user;
        }
        else {
            return null;
        }

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
        $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, role = :role, specialite = :specialite, poste = :poste, annee_promo = :annee_promo, cv = :cv, motif_partenariat = :motif_partenariat, est_verifie = :est_verifie WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'mdp' => $user->getMdp(),
            'role' => $user->getRole(),
            'specialite' => $user->getSpecialite(),
            'poste' => $user->getPoste(),
            'annee_promo' => $user->getAnneePromo(),
            'cv' => $user->getCv(),
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

    /** Deconnecte l'utilisateur */
    public function deconnect()
    {
        session_start();
        session_destroy();
        header("Location: ../../index.php");
    }
    public function rechercheUtilisateurParMail($email)
    {
        $recherche = "SELECT * FROM utilisateur WHERE email = :email";
        $req = $this->bdd->getBdd()->prepare($recherche);
        $req->execute(array(
            'email' => $email
        ));
        return $req->fetch();
    }
    public function addTokens($token,$dateFin,$email)
    {
        $add="update utilisateur SET reset_token=:token, reset_expires=:dateFin
                WHERE email=:email";
        $req = $this->bdd->getBdd()->prepare($add);
        $req->execute(array(
            'token' => $token,
            'dateFin' => $dateFin,
            "email" => $email

        ));
        if($req){
            return true;
        }
        else{
            return false;
        }

    }
    public function verifierToken($token)
    {
        $verif="SELECT email,mdp FROM utilisateur WHERE reset_token=:token";
        $req = $this->bdd->getBdd()->prepare($verif);
        $req->execute(array(
            'token' => $token
        ));
        return $req->fetch();
    }
    public function changerMdp($mdp,$email)
    {
        $update = "UPDATE utilisateur SET mdp=:mdp,reset_token=null,reset_expires=null WHERE email=:email";
        $req = $this->bdd->getBdd()->prepare($update);
        $req->execute(array(
            'mdp' => $mdp,
            'email' => $email
        ));
    }
    public function getNomEntreprise()
    {
        $sql = "SELECT DISTINCT nom FROM entreprise ORDER BY nom ASC";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getNomFormation()
    {
        $sql = "SELECT DISTINCT nom_formation FROM formation ORDER BY nom_formation ASC";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}