<?php
// Repository gérant toutes les opérations en base de données liées aux utilisateurs
class UtilisateurRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Récupère le détail d'un utilisateur par son identifiant */
    public function detailUtilisateur($id)
    {
        if (empty($id)) return null;

        $sql = 'SELECT * FROM utilisateur WHERE id_utilisateur = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Inscription d'un nouvel utilisateur depuis le formulaire public */
    public function inscription(Utilisateur $user)
    {
        // Vérifie si l'adresse email est déjà enregistrée
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(['email' => $user->getEmail()]);
        $donne = $req2->fetch();

        if ($donne == NULL) {
            // Insertion du nouvel utilisateur (compte en attente de vérification par un admin)
            $sql = 'INSERT INTO Utilisateur(nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute([
                'nom'    => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email'  => $user->getEmail(),
                'mdp'    => $user->getMdp(),
            ]);
            return $res;
        } else {
            // Email déjà utilisé : redirection vers l'accueil
            header('Location: ../../index.php');
            exit();
        }
    }

    /** Ajout d'un utilisateur directement par un administrateur */
    public function ajout(Utilisateur $user)
    {
        // Vérifie si l'adresse email est déjà enregistrée
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(['email' => $user->getEmail()]);
        $donne = $req2->fetch();

        if ($donne === false) {
            $sql = 'INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'nom'    => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email'  => $user->getEmail(),
                'mdp'    => $user->getMdp(),
            ]);
        }

        // Email déjà pris : retourne false
        return false;
    }

    /** Vérifie les identifiants et retourne l'objet Utilisateur si la connexion réussit */
    public function connexion(Utilisateur $user)
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['email' => $user->getEmail()]);
        $donne = $req->fetch();

        if ($donne && password_verify($user->getMdp(), $donne['mdp'])) {
            // Compte non encore vérifié par un administrateur
            if ($donne['est_verifie'] != 1) {
                return [
                    'success' => false,
                    'message' => "Votre compte n'est pas encore vérifié."
                ];
            }

            // Hydratation de l'objet Utilisateur avec les données de la BDD
            $user->setNom($donne['nom']);
            $user->setPrenom($donne['prenom']);
            $user->setEmail($donne['email']);
            $user->setRole($donne['role']);
            $user->setIdUtilisateur($donne['id_utilisateur']);

            return $user;
        }

        // Email ou mot de passe incorrect
        return [
            'success' => false,
            'message' => 'Email ou mot de passe incorrect.'
        ];
    }

    /** Retourne la liste de tous les utilisateurs */
    public function listeUtilisateur()
    {
        $sql = 'SELECT * FROM utilisateur';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Modification complète d'un utilisateur par un administrateur (tous les champs) */
    public function modificationAdmin(Utilisateur $user)
    {
        $sql = "UPDATE utilisateur
                SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, role = :role,
                    specialite = :specialite, poste = :poste, annee_promo = :annee_promo,
                    cv = :cv, motif_partenariat = :motif_partenariat, est_verifie = :est_verifie
                WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom'               => $user->getNom(),
            'prenom'            => $user->getPrenom(),
            'email'             => $user->getEmail(),
            'mdp'               => $user->getMdp(),
            'role'              => $user->getRole(),
            'specialite'        => $user->getSpecialite(),
            'poste'             => $user->getPoste(),
            'annee_promo'       => $user->getAnneePromo(),
            'cv'                => $user->getCv(),
            'motif_partenariat' => $user->getMotifPartenariat(),
            'est_verifie'       => $user->getEstVerifie(),
            'id'                => $user->getIdUtilisateur()
        ]);
    }

    /** Valide un compte utilisateur (passe est_verifie à 1) */
    public function validationUtilisateur(Utilisateur $user)
    {
        $sql = "UPDATE utilisateur SET est_verifie = :validation WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'validation' => 1,
            'id'         => $user->getIdUtilisateur()
        ]);
    }

    /** Modification des informations de base par l'utilisateur lui-même */
    public function modificationUtilisateur(Utilisateur $user)
    {
        $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp WHERE id_utilisateur = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'nom'    => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email'  => $user->getEmail(),
            'mdp'    => $user->getMdp(),
            'id'     => $user->getIdUtilisateur()
        ]);
    }

    /** Supprime un utilisateur par son identifiant */
    public function suppression(Utilisateur $user)
    {
        $sql = 'DELETE FROM utilisateur WHERE id_utilisateur = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $user->getIdUtilisateur()]);
    }

    /** Retourne le nombre total d'utilisateurs inscrits */
    public function nombreUtilisateur()
    {
        $sql = 'SELECT COUNT(*) FROM utilisateur';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    /** Déconnecte l'utilisateur en détruisant la session */
    public function deconnect()
    {
        session_start();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }

    /** Recherche un utilisateur par son adresse email (pour la réinitialisation de mot de passe) */
    public function rechercheUtilisateurParMail($email)
    {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['email' => $email]);
        return $req->fetch();
    }

    /** Enregistre un token de réinitialisation de mot de passe avec sa date d'expiration */
    public function addTokens($token, $dateFin, $email)
    {
        $sql = "UPDATE utilisateur SET token = :token, date_fin = :dateFin WHERE email = :email";
        $req = $this->bdd->getBdd()->prepare($sql);
        // On retourne le résultat de execute() (true/false) et non l'objet PDOStatement
        return $req->execute([
            'token'   => $token,
            'dateFin' => $dateFin,
            'email'   => $email,
        ]);
    }

    /** Vérifie qu'un token de réinitialisation existe et retourne l'email associé */
    public function verifierToken($token)
    {
        $sql = "SELECT email, mdp FROM utilisateur WHERE token = :token";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['token' => $token]);
        return $req->fetch();
    }

    /** Met à jour le mot de passe et efface le token après réinitialisation */
    public function changerMdp($mdp, $email)
    {
        $sql = "UPDATE utilisateur SET mdp = :mdp, token = null, date_fin = '' WHERE email = :email";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute([
            'mdp'   => $mdp,
            'email' => $email
        ]);
    }

    /** Retourne la liste distincte des noms d'entreprises (pour les menus déroulants) */
    public function getNomEntreprise()
    {
        $sql = "SELECT DISTINCT nom FROM entreprise ORDER BY nom ASC";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /** Retourne la liste distincte des noms de formations (pour les menus déroulants) */
    public function getNomFormation()
    {
        $sql = "SELECT DISTINCT nom_formation FROM formation ORDER BY nom_formation ASC";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
