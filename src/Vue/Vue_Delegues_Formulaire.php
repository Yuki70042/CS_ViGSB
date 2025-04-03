<?php

namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Delegues_Formulaire extends Vue_Composant {

    private ?array $delegue;
    private ?array $regions;

    public function __construct(?array $delegue = null, ?array $regions = null) {
        $this->delegue = $delegue;
        $this->regions = $regions;
    }

    public function donneTexte(): string {
        $titre = $this->delegue ? "Modifier un Délégué" : "Ajouter un Délégué";
        $action = $this->delegue ? "traiterModification" : "traiterAjout";
        $idSalarie = $this->delegue['id_salarie'] ?? '';
        $nom = $this->delegue['nom'] ?? '';
        $prenom = $this->delegue['prenom'] ?? '';
        $email = $this->delegue['email'] ?? '';
        $age = $this->delegue['age'] ?? '';
        $adresse = $this->delegue['adresse'] ?? '';
        $region = $this->delegue['region'] ?? '';

        $html = '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Modifier le Compte-Rendu</title>
                    <link rel="stylesheet" href="../public/css/Listes_Table.css"> 
                </head>

            <h1>' . $titre . '</h1>';
            $html .= '<form action="index.php?case=Gerer_Delegues&action=' . $action . '" method="post">
                        ' . ($this->delegue ? '<input type="hidden" name="id_salarie" value="' . htmlspecialchars($idSalarie) . '">' : '') . '
                        <div>
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="' . htmlspecialchars($nom) . '" required>
                        </div>
                        <div>
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="' . htmlspecialchars($prenom) . '" required>
                        </div>
                        <div>
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email" value="' . htmlspecialchars($email) . '" required>
                        </div>
                        <div>
                            <label for="age">Âge :</label>
                            <input type="number" id="age" name="age" value="' . htmlspecialchars($age) . '" required>
                        </div>
                        <div>
                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" name="adresse" value="' . htmlspecialchars($adresse) . '" required>
                        </div>';

            $html .= '<div> <!-- Permet de sélectionner la Region via un menu déroulant -->
                <label for="region">Région :</label>
                <select id="region" name="region" required>';


            // $regions = \App\Modele\Modele_Regions::getRegions();
            foreach ($this->regions as $region) {
                // Vérifier si la région doit être sélectionnée
                $selected = (isset($regionSelectionne) && $region["id_region"] == $regionSelectionne) ? "selected" : "";

                $html .= '<option value="' . htmlspecialchars($region["id_region"]) . '" ' . $selected . '>'
                    . htmlspecialchars($region["libelle_region"]) .
                    '</option>';
            }

            $html .= '</select>
            </div>';

            $html .='<div>
                            <label for="mdp">Mot de passe :</label>
                            <input type="password" id="mdp" name="mdp" ' . ($this->delegue ? '' : 'required') . '>
                            <small>' . ($this->delegue ? '(Laisser vide si inchangé)' : '') . '</small>
                        </div>
                        <div>
                            <button type="submit">Enregistrer</button>
                            <a href="index.php?case=Gerer_Delegues&action=voirListe">Annuler</a>
                        </div>
                      </form>';

            $html .=" <!-- Bouton Retour -->
                <form method='GET' action='index.php'>
                   <input type='hidden' name='case' value='visiteur'>
                   <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
                   <button type='submit'>Retour au menu principal</button>
                </form>  ";

        return $html;
    }
}
