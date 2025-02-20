<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Visite_Formulaire extends Vue_Composant {

    private ?array $salaries;
    private ?array $praticiens;
    private ?array $medicaments;

    public function __construct(?array $salaries = null, ?array $praticiens = null, ?array $medicaments = null ) {
        $this->salaries = $salaries; // Liste des salaries
        $this->praticiens = $praticiens; // Liste des praticiens
        $this->medicaments = $medicaments; // Liste des medicaments
    }

    public function donneTexte(): string {
        // Génère le formulaire HTML
        $html = '
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu Visiteur</title>
        <link rel="stylesheet" href="../public/Visite_Formulaire.css"> 
    </head>
    
    <div class="formulaire-visite">
    <h1>FORMULAIRE RENDEZ-VOUS</h1>
    
    <!-- Bouton de retour -->
    <a href="index.php?action=retour">
    <button type="button">Retour</button>
    </a>
    
    <form action="index.php" method="post">
    
        <input type="hidden" name="case" value="Gerer_Visites">

        <!-- Champs pour sélectionner un praticien -->
        <label for="praticien">Praticien :</label>
        <select id="praticien" name="praticien" required>
            <option value="">Choisir un praticien</option>';

        // Boucle sur les praticiens pour afficher les options
        if ($this->praticiens) {
            foreach ($this->praticiens as $praticien) {
                $html .= '<option value="' . $praticien['id_pds'] . '">' . $praticien['prenom_pds'] . ' ' . $praticien['nom_pds'] . '</option>';
            }
        }

        $html .= '</select>

        <!-- Champs pour sélectionner le médicament -->
        <label for="medicament">Médicament :</label>
        <select id="medicament" name="medicament" required>
            <option value="">Choisir un médicament</option>';

        // Boucle sur les médicaments pour afficher les options
        if ($this->medicaments) {
            foreach ($this->medicaments as $medicament) {
                $html .= '<option value="' . $medicament['id_medicament'] . '">' . $medicament['designation'] . '</option>';
            }
        }

        $html .= '</select>

        <!-- Champs pour sélectionner un salarié -->
        <label for="salarie">Salarié :</label>
        <select id="salarie" name="salarie" required>
            <option value="">Choisir un salarié</option>';

        // Boucle sur les salariés pour afficher les options
        if ($this->salaries) {
            foreach ($this->salaries as $salarie) {
                $html .= '<option value="' . $salarie['id_salarie'] . '">' . $salarie['prenom'] . ' ' . $salarie['nom'] . '</option>';
            }
        }

        $html .= '</select>

        <!-- Champ pour saisir la date -->
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>

        <!-- Champ pour saisir lheure -->
        <label for="heure">Horaire :</label>
        <input type="time" id="heure" name="heure" required>

        <!-- Bouton de validation -->
        <button type="submit" name="action" value="traiterAjout">Créer</button>
    </form>
</div>';

    return $html;
    }
}