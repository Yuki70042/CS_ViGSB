<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Praticiens_Liste extends Vue_Composant {

    private array $praticiens;

    public function __construct(array $praticiens) {
        $this->praticiens = $praticiens;
    }

    public function donneTexte(): string {
        $html = "<h1>Liste des Professionnels de Santé</h1>

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

        // Construction du tableau des praticiens
        $html .= '<table border="1">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Âge</th>
                            <th>Métier</th>
                            <th>Adresse</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Boucle pour afficher les praticiens
        foreach ($this->praticiens as $praticien) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($praticien['nom_pds']) . '</td>
                        <td>' . htmlspecialchars($praticien['prenom_pds']) . '</td>
                        <td>' . htmlspecialchars($praticien['age_pds']) . '</td>
                        <td>' . htmlspecialchars($praticien['metier']) . '</td>
                        <td>' . htmlspecialchars($praticien['adresse_pds']) . '</td>
                        <td>' . htmlspecialchars($praticien['CP_pds']) . '</td>
                        <td>' . htmlspecialchars($praticien['ville_pds']) . '</td>
                        <td>
                            <a href="index.php?case=Gerer_Praticiens&action=modifier&id_pds=' . $praticien['id_pds'] . '">Modifier</a> |
                            <a href="index.php?case=Gerer_Praticiens&action=supprimer&id_pds=' . $praticien['id_pds'] . '" 
                               onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce praticien ?\')">Supprimer</a>
                        </td>
                      </tr>';
        }

        $html .= '</tbody>
                  </table>';

        // Lien pour ajouter un nouveau praticien
        $html .= '<p><a href="index.php?case=Gerer_Praticiens&action=ajouter" class="btn">Ajouter un praticien</a></p>';

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