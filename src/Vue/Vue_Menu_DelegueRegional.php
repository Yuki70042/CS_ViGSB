<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_DelegueRegional extends Vue_Composant
{
    public function __construct($type_utilisateur)
    {
        $this->type_utilisateur = $type_utilisateur;
    }
    function donneTexte(): string
    {
        return " <nav id='menu'>
                  <ul id='menu-closed'> 
                  
                    <li><a href='?case=Gerer_CompteRendu'>Mes Compte-Rendu</a></li>
                    <li><a href='?case=Gerer_Praticiens'>Gérer les Praticiens</a></li>   
                    <li><a href='?case=Gerer_Visiteurs'>Gérer Les Visiteurs</a></li>
                    <li><a href='?case=Gerer_Visite'>Planifier des Visites</a></li>            
                    
                   </ul>
                </nav> ";
        return '';
    }
}
