<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_ResponsableSecteur extends Vue_Composant
{
    private string $type_utilisateur;
    public function __construct($type_utilisateur)
    {
        $this->type_utilisateur = $type_utilisateur;
    }
    function donneTexte(): string
    {
        return " 
 
                 <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Menu Responsable Secteur</title>
                    <link rel='stylesheet' href='../public/Menu_Delegues.css'> 
                 </head>
 
                <nav id='menu'>
                    <div id='menu-container'>
                        <h1>Menu Responsable Secteur</h1>
                        <ul id='menu-closed'> 
                            <li><a href='?case=Gerer_Praticiens&action=voirListe' class='gerer-praticiens'>Gérer les Praticiens</a></li>
                            <!-- <li><a href='?case=Gerer_Visiteurs' class='gerer-visiteurs'>Gérer Les Visiteurs</a></li> -->
                            <li><a href='?case=Gerer_Delegues' class='gerer-delegues'>Gérer Les Délégués</a></li>
                            <li><a href='?case=Gerer_Visites&action=voirVisitesRegion' class='planifier-visites'>Voir les Visites</a></li>   
                            <li><a href='?case=Gerer_Medicaments&action=voirListe' class='gerer-medicaments'>Gérer les Médicaments</a></li>        
                            <li><a href='index.php?case=deconnexion' class='deconnexion'>Se déconnecter</a></li> 
                        </ul>
                    </div>
                </nav> ";
        return '';
    }
}
