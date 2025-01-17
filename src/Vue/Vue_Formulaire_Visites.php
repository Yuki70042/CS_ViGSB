<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Formulaire_Visites extends Vue_Composant
{
    public function __construct()
    {
    }

    public function donneTexte(): string
    {
        // Génère le formulaire HTML
        $str= '<div class="formulaire-visite">
            <h1>FORMULAIRE RENDEZ-VOUS</h1>
            
            <!-- Bouton de retour -->
            <a href="index.php?action=retour">
            <button type="button">Retour</button>
            </a>
            
            <form action="index.php" method="post">
                <!-- Champs pour sélectionner un visiteur -->
                <label for="visiteur">Visiteur :</label>
                <input type="text" id="visiteur" name="visiteur" placeholder="Nom du visiteur" required>
                <button type="button" class="btn-search">🔍</button>

                <!-- Champs pour sélectionner un praticien -->
                <label for="praticien">Praticien :</label>
                <input type="text" id="praticien" name="praticien" placeholder="Nom du praticien" required>
                <button type="button" class="btn-search">🔍</button>

                <!-- Champ pour saisir la date -->
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>

                <!-- Champ pour saisir lheure -->
                <label for="heure">Horaire :</label>
                <input type="time" id="heure" name="heure" required>

                <!-- Champ pour saisir ladresse -->
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" placeholder="Adresse" required>

                <!-- Section pour les médicaments -->
                <label for="medicaments">Médicaments :</label>
                <textarea id="medicaments" name="medicaments" placeholder="Liste des médicaments"></textarea>

                <!-- Bouton de validation -->
                <button type="submit" name="action" value="validerCreationVisite">Créer</button>
            </form>
        </div>

        <style>
            .formulaire-visite {
                font-family: Arial, sans-serif;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
                width: 50%;
                margin: auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .formulaire-visite h1 {
                text-align: center;
                color: #333;
            }

            .formulaire-visite form {
                display: flex;
                flex-direction: column;
            }

            .formulaire-visite label {
                margin: 10px 0 5px;
                font-weight: bold;
            }

            .formulaire-visite input, .formulaire-visite textarea, .formulaire-visite button {
                margin-bottom: 15px;
                padding: 10px;
                font-size: 1rem;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .formulaire-visite button {
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
            }

            .formulaire-visite button:hover {
                background-color: #0056b3;
            }

            .formulaire-visite .btn-search {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 1.2rem;
                margin-left: 5px;
            }
        </style>';

        return $str;
    }
}
