<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Medicaments_Liste extends Vue_Composant {

    private array $medicaments;

    public function __construct(array $medicaments) {
        $this->medicaments = $medicaments;
    }

    public function donneTexte(): string {
        $html = "<h1>Liste des Medicaments en Visite</h1>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Modifier le Compte-Rendu</title>
                    <link rel='stylesheet' href='../public/css/Liste.css'> 
                </head>";

        // Vérifie s'il y a un message dans la session
        if (isset($_SESSION['message'])) {
            $html .= '<p class="message-success">' . htmlspecialchars($_SESSION['message']) . '</p>';
            unset($_SESSION['message']); // Supprime le message pour ne plus l'afficher
        }

        // Construction du tableau des Médicaments
        $html .= '<table border="1">
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Boucle pour afficher les praticiens
        foreach ($this->medicaments as $medicament) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($medicament['designation']) . '</td>
                        <td>' . htmlspecialchars($medicament['prix']) . '</td>

                        <td>
                            <a href="index.php?case=Gerer_Medicaments&action=modifier&id_medicament=' . $medicament['id_medicament'] . '">Modifier</a> |
                            <a href="index.php?case=Gerer_Medicaments&action=supprimer&id_medicament=' . $medicament['id_medicament'] . '" 
                               onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce Médicament ?\')">Supprimer</a>
                        </td>
                      </tr>';
        }

        $html .= '</tbody>
                  </table>';

        // Lien pour ajouter un nouveau praticien
        $html .= '<p><a href="index.php?case=Gerer_Medicaments&action=ajouter" class="btn">Ajouter un Medicament</a></p>';

        // Bouton de retour au menu principal
        $html .= " <!-- Bouton Retour -->
            <form method='GET' action='index.php'>
               <input type='hidden' name='case' value='praticien'>
               <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
               <button type='submit'>Retour au menu principal</button>
            </form>  ";

        return $html;
    }
}