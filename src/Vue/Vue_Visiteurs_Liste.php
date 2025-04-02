<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Visiteurs_Liste extends Vue_Composant {

    private array $visiteurs;

    public function __construct(array $visiteurs) {
        $this->visiteurs = $visiteurs;
    }

    public function donneTexte(): string {
        $html = "<h1>Liste des visiteurs</h1>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Liste des Visiteurs</title>
                    <link rel='stylesheet' href='../public/css/Liste.css'> 
                </head>";

        // Vérifie s'il y a un message dans la session
        if (isset($_SESSION['message'])) {
            $html .= '<p class="message-success">' . htmlspecialchars($_SESSION['message']) . '</p>';
            unset($_SESSION['message']);
        }

        $html .= '<table border="1">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Âge</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($this->visiteurs as $visiteur) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($visiteur['nom']) . '</td>
                        <td>' . htmlspecialchars($visiteur['prenom']) . '</td>
                        <td>' . htmlspecialchars($visiteur['email']) . '</td>
                        <td>' . htmlspecialchars($visiteur['age']) . '</td>
                        <td>' . htmlspecialchars($visiteur['adresse']) . '</td>
                        <td>
                            <a href="index.php?case=Gerer_Visiteurs&action=modifier&id_salarie=' . $visiteur['id_salarie'] . '">Modifier</a> |
                            <a href="index.php?case=Gerer_Visiteurs&action=supprimer&id_salarie=' . $visiteur['id_salarie'] . '" 
                               onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce visiteur ?\')">Supprimer</a>
                        </td>
                      </tr>';
        }

        $html .= '</tbody>
                  </table>';

        $html .= '<p><a href="index.php?case=Gerer_Visiteurs&action=ajouter" class="btn">Ajouter un visiteur</a></p>';

        $html .= " <!-- Bouton Retour -->
            <form method='GET' action='index.php'>
               <input type='hidden' name='case' value='visiteur'>
               <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
               <button type='submit'>Retour au menu principal</button>
            </form>  ";

        return $html;
    }
}
