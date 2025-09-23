<?php

namespace bdd;
use PDO;
use PDOException;

class Bdd
{
    private $bdd;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=projetlprs;charset=utf8', 'root', '');
            echo 'reussi';

        }catch (PDOException $e){
            echo 'Erreur de connexion a la bdd : '.$e->getMessage();
        }
    }

    public function getBdd()
    {
        return $this->bdd;
    }
}
