<?php
class PostForumRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function ajout(PostForum $postForum)
    {
        $sql = "INSERT INTO post_forum 
                (titre_post_forum, contenu_post_forum, date_creation_post_forum, ref_categorie_forum, ref_utilisateur)
                VALUES (:titre, :contenu, :date_creation, :ref_categorie_forum, :ref_utilisateur)";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'titre' => $postForum->getTitre(),
            'contenu' => $postForum->getContenu(),
            'date_creation' => $postForum->getDateCreation(),
            'ref_categorie_forum' => $postForum->getRefCategorieForum(),
            'ref_utilisateur' => $postForum->getRefUtilisateur()
        ]);
    }

    public function modification(PostForum $postForum)
    {
        $sql = 'UPDATE post_forum 
                SET titre_post_forum = :titre, 
                    contenu_post_forum = :contenu, 
                    date_creation_post_forum = :date_creation, 
                    ref_categorie_forum = :ref_categorie_forum, 
                    ref_utilisateur = :ref_utilisateur 
                WHERE id_post = :id';
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute([
            'titre' => $postForum->getTitre(),
            'contenu' => $postForum->getContenu(),
            'date_creation' => $postForum->getDateCreation(),
            'ref_categorie_forum' => $postForum->getRefCategorieForum(),
            'ref_utilisateur' => $postForum->getRefUtilisateur(),
            'id' => $postForum->getIdPost()
        ]);
    }

    public function suppression(PostForum $postForum)
    {
        $sql = "DELETE FROM post_forum WHERE id_post = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        return $req->execute(['id' => $postForum->getIdPost()]);
    }

    public function listePost()
    {
        $sql = "SELECT * FROM post_forum";
        $req = $this->bdd->getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}