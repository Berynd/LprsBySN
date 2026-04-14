<?php
// Classe de connexion à la base de données via PDO
// Fournit une instance PDO partagée à tous les repositories
class BDD
{
    private $bdd;

    public function __construct()
    {
        // Connexion PDO à la base MySQL locale avec encodage UTF-8
        $this->bdd = new PDO('mysql:host=localhost;dbname=projetlprs;charset=utf8', 'root', '');
        // Activation des erreurs PDO sous forme d'exceptions
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /** Retourne l'instance PDO */
    public function getBDD()
    {
        return $this->bdd;
    }
}
