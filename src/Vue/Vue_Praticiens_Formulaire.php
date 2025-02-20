<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Praticiens_Formulaire extends Vue_Composant {

    private ?array $praticiens;

    public function __construct(?array $praticiens = null) {
        $this->praticiens = $praticiens;
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
                    <link rel="stylesheet" href="../public/Listes_Table.css"> 
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
                    </div>
        
                    <div>
                        <button type="submit">Enregistrer</button>
                        <a href="index.php?case=Gerer_Praticiens&action=voirListe">Annuler</a>
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
