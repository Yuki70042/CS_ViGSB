<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_Visiteur extends Vue_Composant
{
    public function __construct($type_utilisateur)
    {
        $this->type_utilisateur = $type_utilisateur;
    }
    function donneTexte(): string
    {
        $str= "<H1>Bienvenue sur le  Menu du visiteur !</H1> ";
        return $str;
    }
}
