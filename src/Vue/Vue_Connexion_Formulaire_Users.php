<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Connexion_Formulaire_Users extends Vue_Composant
{
    private string $msgErreur;
    public function __construct(string $msgErreur ="")
    {
        $this->msgErreur=$msgErreur;
    }

    function donneTexte(): string
    {
        $str = "
<div class='main-container'>
    <div class='login-box'>
        <h1>BIENVENUE SUR VIGSB !</h1>";

        // Afficher le message d'erreur s'il y en a un
        if (!empty($this->msgErreur)) {
            $str .= "<div class='error-message' style='color: red; font-weight: bold;'>"
                . htmlspecialchars($this->msgErreur) .
                "</div>";
        }

        $str .= "
        <form action='index.php' method='post'>
            <label for='email'>IDENTIFIANT</label>
            <input type='text' id='email' placeholder='Identifiant' name='email' required>

            <label for='password'>MOT DE PASSE</label>
            <input type='password' id='password' placeholder='Mot de passe' name='password' required>

            <button type='submit' id='submit' name='action' value='Se connecter'>SE CONNECTER</button>
        </form>

        <form>
            <h1>Mot de passe perdu ?</h1>
            <button type='submit' id='submit' name='action' value='reinitmdp'>Réinitialiser le mdp</button>
        </form>
    </div>

    <div class='stats-box'>
        <div class='stat'>
            <h3>CONSULTATION GLOBALE RESTANTE</h3>
            <div class='stat-value'>134</div>
        </div>
        <div class='stat'>
            <h3>EFFECTIF GLOBAL</h3>
            <div class='stat-value'>56</div>
        </div>
        <div class='stat'>
            <h3>OBJECTIF</h3>
            <div class='progress'>
                <div class='progress-bar' style='width: 40%'></div>
            </div>
        </div>
    </div>
</div>";

        return $str ;
    }
}