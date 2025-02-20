<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Delegues_Liste extends Vue_Composant {

    private array $delegues;

    public function __construct(array $delegues) {
        $this->delegues = $delegues;
    }

    public function donneTexte(): string {
        $html = "<h1>Liste des Délégués sous mon secteur</h1> 
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Modifier le Compte-Rendu</title>
                    <link rel='stylesheet' href='../public/Liste.css'> 
                </head>";

        // Vérifie s'il y a un message dans la session
        if (isset($_SESSION['message'])) {
            $html .= '<p class="message-success">' . htmlspecialchars($_SESSION['message']) . '</p>';
            unset($_SESSION['message']); // Supprime le message pour ne plus l'afficher
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

        foreach ($this->delegues as $delegue) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($delegue['nom']) . '</td>
                        <td>' . htmlspecialchars($delegue['prenom']) . '</td>
                        <td>' . htmlspecialchars($delegue['email']) . '</td>
                        <td>' . htmlspecialchars($delegue['age']) . '</td>
                        <td>' . htmlspecialchars($delegue['adresse']) . '</td>
                        <td>
                            <a href="index.php?case=Gerer_Delegues&action=modifier&id_salarie=' . $delegue['id_salarie'] . '">Modifier</a> |
                            <a href="index.php?case=Gerer_Delegues&action=supprimer&id_salarie=' . $delegue['id_salarie'] . '" 
                               onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce Délégué ?\')">Supprimer</a>
                        </td>
                      </tr>';
        }

        $html .= '</tbody>
                  </table>';

        $html .= '<p><a href="index.php?case=Gerer_Delegues&action=ajouter" class="btn">Ajouter un Délégué</a></p>';

        $html .= " <!-- Bouton Retour -->
            <form method='GET' action='index.php'>
               <input type='hidden' name='case' value='visiteur'>
               <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
               <button type='submit'>Retour au menu principal</button>
            </form>  ";

        return $html;
    }
}
