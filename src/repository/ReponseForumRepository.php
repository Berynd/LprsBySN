<?php
class ReponseForumRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    /** Ajouter une nouvelle réponse */
    public function ajout(ReponseForum $reponseForum)
    {
        $check = $this->bdd->getBdd()->prepare(
            'SELECT COUNT(*) FROM reponse_forum 
             WHERE contenu_reponse_forum = :contenu 
             AND ref_utilisateur = :ref_utilisateur 
             AND ref_post_forum = :ref_post_forum'
        );
        $check->execute([
            'contenu' => $reponseForum->getContenuReponseForum(),
            'ref_utilisateur' => $reponseForum->getRefUtilisateur(),
            'ref_post_forum' => $reponseForum->getRefPostForum()
        ]);

        if ($check->fetchColumn() == 0) {
            $sql = 'INSERT INTO reponse_forum 
                    (contenu_reponse_forum, date_creation_reponse_forum, ref_post_forum, ref_utilisateur)
                    VALUES (:contenu, :date_creation, :ref_post_forum, :ref_utilisateur)';
            $req = $this->bdd->getBdd()->prepare($sql);
            return $req->execute([
                'contenu' => $reponseForum->getContenuReponseForum(),
                'date_creation' => $reponseForum->getDateCreationReponseForum(),
                'ref_post_forum' => $reponseForum->getRefPostForum(),
                'ref_utilisateur' => $reponseForum->getRefUtilisateur()
            ]);
        }

        return false;
    }

    /** Lister toutes les réponses */
    public function listeReponsesForum()
    {
        $sql = 'SELECT * FROM reponse_forum ORDER BY date_creation_reponse_forum DESC';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lister les réponses d’un post */
    public function listeReponsesParPost($idPost)
    {
        $sql = 'SELECT * FROM reponse_forum 
                WHERE ref_post_forum = :id_post 
                ORDER BY date_creation_reponse_forum ASC';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id_post' => $idPost]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Obtenir une réponse par ID */
    public function getReponseById($idReponse)
    {
        $sql = 'SELECT * FROM reponse_forum WHERE id_reponse_forum = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id' => $idReponse]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /** Compter le total de réponses */
    public function nombreReponsesForum()
    {
        $sql = 'SELECT COUNT(*) FROM reponse_forum';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchColumn();
    }

    /** Compter le nombre de réponses d’un post */
    public function nombreReponsesParPost($idPost)
    {
        $sql = 'SELECT COUNT(*) FROM reponse_forum WHERE ref_post_forum = :id_post';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id_post' => $idPost]);
        return $req->fetchColumn();
    }

    /** Supprimer une réponse */
    public function suppression(ReponseForum $reponseForum)
    {
        $sql = 'DELETE FROM reponse_forum WHERE id_reponse_forum = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $reponseForum->getIdReponseForum()]);
    }

    /** Modifier une réponse */
    public function modification(ReponseForum $reponseForum)
    {
        $sql = 'UPDATE reponse_forum 
                SET contenu_reponse_forum = :contenu, 
                    date_creation_reponse_forum = :date_creation, 
                    ref_post_forum = :ref_post_forum, 
                    ref_utilisateur = :ref_utilisateur 
                WHERE id_reponse_forum = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'contenu' => $reponseForum->getContenuReponseForum(),
            'date_creation' => $reponseForum->getDateCreationReponseForum(),
            'ref_post_forum' => $reponseForum->getRefPostForum(),
            'ref_utilisateur' => $reponseForum->getRefUtilisateur(),
            'id' => $reponseForum->getIdReponseForum()
        ]);
    }

    /** Lister les réponses d’un utilisateur */
    public function listeReponsesParUtilisateur($idUtilisateur)
    {
        $sql = 'SELECT * FROM reponse_forum 
                WHERE ref_utilisateur = :id_utilisateur 
                ORDER BY date_creation_reponse_forum DESC';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['id_utilisateur' => $idUtilisateur]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Recherche dans les réponses */
    public function rechercherReponses($motCle)
    {
        $sql = 'SELECT * FROM reponse_forum 
                WHERE contenu_reponse_forum LIKE :mot_cle 
                ORDER BY date_creation_reponse_forum DESC';
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute(['mot_cle' => '%' . $motCle . '%']);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}