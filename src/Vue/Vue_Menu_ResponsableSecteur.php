<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_ResponsableSecteur extends Vue_Composant
{
    public function __construct($type_utilisateur)
    {
        $this->type_utilisateur = $type_utilisateur;
    }
    function donneTexte(): string
    {
        return " <p> Menu ResponsableSecteur initialisation tout est bon! </p>";
        return "";
    }
}
