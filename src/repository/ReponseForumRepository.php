<?php

namespace repository;

class ReponseForumRepository
{
    private $bdd;
    
    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /**
     * Ajouter une nouvelle réponse au forum
     */
    public function ajout(ReponseForum $reponseForum)
    {
        // Vérifier si la réponse existe déjà (basé sur le contenu et l'utilisateur)
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM reponse_forum WHERE contenu = :contenu AND ref_utilisateur = :ref_utilisateur');
        $req2->execute(array(
            'contenu' => $reponseForum->getContenuReponseForum(),
            'ref_utilisateur' => $reponseForum->getRefUtilisateur()
        ));
        $donne = $req2->fetch();
        
        if ($donne == NULL) {
            $sql = 'INSERT INTO reponse_forum(contenu, date_creation, ref_post_forum, ref_utilisateur)
                    VALUES (:contenu, :date_creation, :ref_post_forum, :ref_utilisateur)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'contenu' => $reponseForum->getContenuReponseForum(),
                'date_creation' => $reponseForum->getDateCreationReponseForum(),
                'ref_post_forum' => $reponseForum->getRefPostForum(),
                'ref_utilisateur' => $reponseForum->getRefUtilisateur()
            ));

            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; // La réponse existe déjà
        }
    }

    /**
     * Lister toutes les réponses du forum
     */
    public function listeReponsesForum()
    {
        $sqlReponse = 'SELECT * FROM reponse_forum ORDER BY date_creation DESC';
        $reqReponse = $this->bdd->getBDD()->prepare($sqlReponse);
        $reqReponse->execute();

        return $reqReponse->fetchAll();
    }

    /**
     * Lister les réponses d'un post spécifique
     */
    public function listeReponsesParPost($idPost)
    {
        $sqlReponse = 'SELECT * FROM reponse_forum WHERE ref_post_forum = :id_post ORDER BY date_creation ASC';
        $reqReponse = $this->bdd->getBDD()->prepare($sqlReponse);
        $reqReponse->execute(array('id_post' => $idPost));

        return $reqReponse->fetchAll();
    }

    /**
     * Récupérer une réponse par son ID
     */
    public function getReponseById($idReponse)
    {
        $sqlReponse = 'SELECT * FROM reponse_forum WHERE id_reponse_forum = :id';
        $reqReponse = $this->bdd->getBDD()->prepare($sqlReponse);
        $reqReponse->execute(array('id' => $idReponse));

        return $reqReponse->fetch();
    }

    /**
     * Compter le nombre total de réponses
     */
    public function nombreReponsesForum()
    {
        $sqlNombreReponse = 'SELECT COUNT(*) FROM reponse_forum';
        $reqNombreReponse = $this->bdd->getBdd()->prepare($sqlNombreReponse);
        $reqNombreReponse->execute();

        return $reqNombreReponse->fetchColumn();
    }

    /**
     * Compter le nombre de réponses pour un post spécifique
     */
    public function nombreReponsesParPost($idPost)
    {
        $sqlNombreReponse = 'SELECT COUNT(*) FROM reponse_forum WHERE ref_post_forum = :id_post';
        $reqNombreReponse = $this->bdd->getBdd()->prepare($sqlNombreReponse);
        $reqNombreReponse->execute(array('id_post' => $idPost));

        return $reqNombreReponse->fetchColumn();
    }

    /**
     * Supprimer une réponse du forum
     */
    public function suppression(ReponseForum $reponseForum)
    {
        $sqlSuppression = 'DELETE FROM reponse_forum WHERE id_reponse_forum = :id';
        $reqSuppression = $this->bdd->getBdd()->prepare($sqlSuppression);
        $resSuppression = $reqSuppression->execute(array(
            'id' => $reponseForum->getIdReponseForum()
        ));
        
        return $resSuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    /**
     * Modifier une réponse du forum
     */
    public function modification(ReponseForum $reponseForum)
    {
        $sqlModification = "UPDATE reponse_forum SET contenu = :contenu, date_creation = :date_creation, ref_post_forum = :ref_post_forum, ref_utilisateur = :ref_utilisateur WHERE id_reponse_forum = :id";
        $reqModification = $this->bdd->getBdd()->prepare($sqlModification);
        $resModification = $reqModification->execute(array(
            'contenu' => $reponseForum->getContenuReponseForum(),
            'date_creation' => $reponseForum->getDateCreationReponseForum(),
            'ref_post_forum' => $reponseForum->getRefPostForum(),
            'ref_utilisateur' => $reponseForum->getRefUtilisateur(),
            'id' => $reponseForum->getIdReponseForum()
        ));
        
        return $resModification ? "Modification réussie" : "Échec de la modification";
    }

    /**
     * Lister les réponses d'un utilisateur spécifique
     */
    public function listeReponsesParUtilisateur($idUtilisateur)
    {
        $sqlReponse = 'SELECT * FROM reponse_forum WHERE ref_utilisateur = :id_utilisateur ORDER BY date_creation DESC';
        $reqReponse = $this->bdd->getBDD()->prepare($sqlReponse);
        $reqReponse->execute(array('id_utilisateur' => $idUtilisateur));

        return $reqReponse->fetchAll();
    }

    /**
     * Rechercher des réponses par contenu
     */
    public function rechercherReponses($motCle)
    {
        $sqlRecherche = 'SELECT * FROM reponse_forum WHERE contenu LIKE :mot_cle ORDER BY date_creation DESC';
        $reqRecherche = $this->bdd->getBDD()->prepare($sqlRecherche);
        $reqRecherche->execute(array('mot_cle' => '%' . $motCle . '%'));

        return $reqRecherche->fetchAll();
    }
}