<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_Visiteur extends Vue_Composant
{
    public function __construct()
    {

    }

    function donneTexte(): string
    {
        return "
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Menu Visiteur</title>
            <link rel='stylesheet' href='../public/Menu_Visiteurs.css'> 
        </head>
                
        <div class='menu-container'>
            <div class='menu'>
                <h1>Menu Visiteur</h1>
                <ul class='menu-list'>
                    <li><a href='index.php?case=voirVisites&action=voirVisites' class='menu-link'>Voir mes visites</a></li>
                    <li><a href='index.php?case=voirVisites&action=historique' class='menu-link'>Historique de mes visites</a></li>
                    <li><a href='index.php?case=deconnexion' class='menu-link deconnexion'>Se déconnecter</a></li>
                </ul>
            </div>
        </div>
        ";
    }
}
