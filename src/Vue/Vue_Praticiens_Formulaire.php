<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Praticiens_Formulaire extends Vue_Composant {

    private ?array $praticiens;
    private ?array $regions;

    public function __construct(?array $praticiens = null, ?array $regions = null) {
        $this->praticiens = $praticiens;
        $this->regions = $regions;
    }

    public function donneTexte(): string {
        $titre = $this->praticiens ? "Modifier un Professionnel de santé" : "Ajouter un Professionnel de santé";
        $action = $this->praticiens ? "traiterModification" : "traiterAjout";
        $idPds = $this->praticiens['id_pds'] ?? '';
        $nom = $this->praticiens['nom_pds'] ?? '';
        $prenom = $this->praticiens['prenom_pds'] ?? '';
        $age = $this->praticiens['age_pds'] ?? '';
        $metier = $this->praticiens['metier'] ?? '';
        $adresse = $this->praticiens['adresse_pds'] ?? '';
        $cp = $this->praticiens['CP_pds'] ?? '';
        $ville = $this->praticiens['ville_pds'] ?? '';

        $html = '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Modifier le Compte-Rendu</title>
                    <link rel="stylesheet" href="../public/css/Listes_Table.css"> 
                </head>
                
                <h1>' . $titre . '</h1>';
        $html .= '<form action="index.php?case=Gerer_Praticiens&action=' . $action . '" method="post">
                    ' . ($this->praticiens ? '<input type="hidden" name="id_pds" value="' . htmlspecialchars($idPds) . '">' : '') . '
                    <div>
                        <label for="nom_pds">Nom :</label>
                        <input type="text" id="nom_pds" name="nom_pds" value="' . htmlspecialchars($nom) . '" required>
                    </div>
                    <div>
                        <label for="prenom_pds">Prénom :</label>
                        <input type="text" id="prenom_pds" name="prenom_pds" value="' . htmlspecialchars($prenom) . '" required>
                    </div>
                    <div>
                        <label for="age_pds">Âge :</label>
                        <input type="text" id="age_pds" name="age_pds" value="' . htmlspecialchars($age) . '" required>
                    </div>
                    <div>
                        <label for="metier">Métier :</label>
                        <input type="text" id="metier" name="metier" value="' . htmlspecialchars($metier) . '" required>
                    </div>
                    <div>
                        <label for="adresse_pds">Adresse :</label>
                        <input type="text" id="adresse_pds" name="adresse_pds" value="' . htmlspecialchars($adresse) . '" required>
                    </div>
                    <div>
                        <label for="CP_pds">Code Postal :</label>
                        <input type="text" id="CP_pds" name="CP_pds" value="' . htmlspecialchars($cp) . '" required>
                    </div>
                    <div>
                        <label for="ville_pds">Ville :</label>
                        <input type="text" id="ville_pds" name="ville_pds" value="' . htmlspecialchars($ville) . '" required>
                    </div>';

        $html .= '<div>';
        $html .= '<label for="id_region">Région :</label>';

        if ($_SESSION["typeConnexionBack"] === "delegue") {
            if (isset($this->regions[0]['id_region'], $this->regions[0]['libelle_region'])) {
                $html .= '<input type="hidden" id="id_region" name="id_region" value="' . intval($this->regions[0]["id_region"]) . '">';
                $html .= '<input type="text" value="' . htmlspecialchars($this->regions[0]["libelle_region"]) . '" readonly>';
            } else {
                // Gestion du cas où aucune région n'est disponible
                $html .= '<input type="hidden" id="id_region" name="id_region" value="">';
                $html .= '<input type="text" value="Aucune région disponible" readonly>';
            }
        } else {
            // Sinon, afficher un select avec les différentes régions
            $html .= '<select id="id_region" name="id_region" required>';
            $html .= '<option value="" disabled selected>-- Sélectionnez une région --</option>';

            foreach ($this->regions as $region) {
                $selected = (isset($this->praticiens['id_region']) && $this->praticiens['id_region'] == $region["id_region"]) ? "selected" : "";
                $html .= '<option value="' . intval($region["id_region"]) . '" ' . $selected . '>' . htmlspecialchars($region["libelle_region"]) . '</option>';
            }

            $html .= '</select>';
        }

        $html .= '</div>';


        $html .= '  <div>
                            <button type="submit" >Enregistrer</button>
                            <a href="index.php?case=Gerer_Praticiens&action=voirListe">Annuler</a>
                        </div>
                  </form>';



                $html .=" <!-- Bouton Retour -->
                    <form method='GET' action='index.php'>
                       <input type='hidden' name='case' value='visiteur'>
                       <input type='hidden' name='action' value='menuPrincipal'>
                       <button type='submit'>Retour au menu principal</button>
                    </form>  ";

        return $html;
    }
}
