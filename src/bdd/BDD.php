<?php

class BDD
{
    private $bdd;

    public function __construct()
    {
            $this->bdd = new PDO('mysql:host=localhost:8889;dbname=projetlprs;charset=utf8', 'root', 'root');
    }

    public function getBDD()
    {
        return $this->bdd;
    }
}
