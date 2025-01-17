<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Affichage_Visites extends Vue_Composant
{
    private array $visites;

    public function __construct(array $visites)
    {
        $this->visites = $visites;
    }

    public function donneTexte(): string
    {
        $str = "<h2>Liste des visites</h2>";
        $str .= "<table border='1'>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Professionnel de santé</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach ($this->visites as $visite) {
            $str .= "<tr>
                        <td><a href='index.php?action=modifierVisite&id={$visite['id_pds']}&date={$visite['date_du_rdv']}'>
                            {$visite['date_du_rdv']}
                        </a></td>
                        <td>{$visite['heure_du_rdv']}</td>
                        <td>{$visite['id_pds']}</td>
                        <td>{$visite['commentaire']}</td>
                     </tr>";
        }
        $str .= "</tbody></table>";

        // Bouton pour créer une nouvelle visite
        $str .= "<form method='post'>
                    <button type='submit' name='action' value='creerVisite'>Créer une Visite</button>
                 </form>";

        return $str;
    }
}
