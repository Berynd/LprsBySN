<?php

namespace repository;

class PostForumRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }
    public function ajoutPost(PostForum  $postForum)
    {
        $sql = "INSERT INTO postForum (titre,contenu,date_creation,ref_categorie_forum,ref_utilisateur) VALUES (:titre,:contenu,:date_creation,:ref_categorie_forum, :ref_utilisateur)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'titre' => $postForum->getTitre(),
            'contenu' => $postForum->getContenu(),
            'date_creation' => $postForum->getDateCreation(),
            'ref_categorie_forum' => $postForum->getRefCategorieForum(),
            'ref_utilisateur' => $postForum->getRefUtilisateur()

        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
        public function modifPost(PostForum $postForum)
    {
        $sql = 'UPDATE offre SET titre=:titre,contenu=:contenu,date_creation=:date_creation,ref_categorie_forum=:ref_categorie_forum,ref_utilisateur=:ref_utilisateur WHERE id_post = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(array(
            'titre' => $postForum->getTitre(),
            'contenu' => $postForum->getcontenu(),
            'date_creation' => $postForum->getDateCreation(),
            'ref_categorie_forum' => $postForum->getRefCategorieForum(),
            'ref_utilisateur' => $postForum->getRefUtilisateur(),
            'id' => $postForum->getIdOffre()
        ));

    }
    public function supPostForum(PostForum $postForum)
    {
        $sql = "DELETE FROM offre WHERE id = :id";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute([
                "id" => $postForum->getIdOffre()
            ]
        );
    }

}