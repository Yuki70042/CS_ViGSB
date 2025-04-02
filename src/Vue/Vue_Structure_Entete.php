<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Structure_Entete  extends Vue_Composant
{
    public function __construct()
    {
    }

    function donneTexte(): string
    {

        return "<html>
        <head>
           <meta charset='utf-8'>
            <!-- importer le fichier de style -->
            <link rel='stylesheet' href='.\public\css\style.css' media='screen' type='text/css' />
        </head>
        
        
        <body>
            <header>              
               <div class='company'>
                   <img src='..\..\public\image\logo.jpg' alt='logo'>
                   <h3>VIGSB</h3>                       
               </div>  
                                    
               <h1>DASHBOARD</h1>
                                       
               <div class='welcome-message'>
                    <span class='date' id='currentDate'></span>
                    <span>BIENVENUE !</span>
               </div>         
            </header>
            
            
            <script>     
    // Script pour afficher la date du jour automatiquement
    const dateElement = document.getElementById('currentDate');
    const today = new Date();
    const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
    const dateString = today.toLocaleDateString('fr-FR', options);
    dateElement.textContent = dateString;
    </script> ";
    }
}