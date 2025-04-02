<?php

namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Visiteurs_Formulaire extends Vue_Composant {

    private ?array $visiteur;

    public function __construct(?array $visiteur = null) {
        $this->visiteur = $visiteur;
    }

    public function donneTexte(): string {
        $titre = $this->visiteur ? "Modifier un visiteur" : "Ajouter un visiteur";
        $action = $this->visiteur ? "traiterModification" : "traiterAjout";
        $idSalarie = $this->visiteur['id_salarie'] ?? '';
        $nom = $this->visiteur['nom'] ?? '';
        $prenom = $this->visiteur['prenom'] ?? '';
        $email = $this->visiteur['email'] ?? '';
        $age = $this->visiteur['age'] ?? '';
        $adresse = $this->visiteur['adresse'] ?? '';

        $html = '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Modifier le Compte-Rendu</title>
                    <link rel="stylesheet" href="../public/css/Listes_Table.css"> 
                </head>
            <h1>' . $titre . '</h1>';
            $html .= '<form action="index.php?case=Gerer_Visiteurs&action=' . $action . '" method="post">
                        ' . ($this->visiteur ? '<input type="hidden" name="id_salarie" value="' . htmlspecialchars($idSalarie) . '">' : '') . '
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
                        </div>
                        <div>
                            <label for="mdp">Mot de passe :</label>
                            <input type="password" id="mdp" name="mdp" ' . ($this->visiteur ? '' : 'required') . '>
                            <small>' . ($this->visiteur ? '(Laisser vide si inchangé)' : '') . '</small>
                        </div>
                        <div>
                            <button type="submit">Enregistrer</button>
                            <a href="index.php?case=Gerer_Visiteurs&action=voirListe">Annuler</a>
                        </div>
                      </form>';

            $html .=" <!-- Bouton Retour -->
                <form method='GET' action='index.php'>
                   <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
                   <button type='submit'>Retour au menu principal</button>
                </form>  ";

        return $html;
    }
}
