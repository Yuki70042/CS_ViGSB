# Installation de l'application VIGSB

L'application **VIGSB** a été développée dans le cadre de mon BTS SIO, option SLAM, en seconde année. Son objectif est de créer un logiciel fonctionnel pour une entreprise, intégrant toutes les pratiques nécessaires à la mise en place d'un projet professionnel.

## Étapes d'installation :

### 1. Installation de XAMPP

Avant de commencer, assurez-vous d'avoir installé XAMPP sur votre ordinateur. XAMPP est une plateforme de développement web qui inclut Apache et MySQL.

- Téléchargez XAMPP ici : [https://www.apachefriends.org/fr/download.html](https://www.apachefriends.org/fr/download.html)

- Une fois téléchargé, installez et lancez XAMPP.

- Démarrez les services **Apache** et **MySQL** via le panneau de contrôle de XAMPP.

  
### 2. Importer le code source du projet

Cloner le projet depuis GitHub sur votre IDE préféré. Assurez-vous de bien récupérer la branche **master**.

- Ouvrez votre IDE (par exemple PhpStorm, VSCode, etc.).

- Clonez ou effectuez un **pull** de la branche **master** du dépôt GitHub de l'application.

  
### 3. Importer la base de données

Pour importer la base de données, suivez ces étapes :

- Dans la console de votre projet, exécutez la commande suivante :  
  `php install.php`
  
  Cette commande va automatiquement importer la base de données initiale appelée **vigsb** dans **PHPMyAdmin**.

- Vous pouvez vérifier l'importation en accédant à PHPMyAdmin via le lien :  
  [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)  

  Ensuite, cliquez sur "Admin" puis sélectionnez le module **MySQL** pour voir la base **vigsb**.

  
### 4. Lancer l'application

- Une fois la base de données importée, ouvrez votre navigateur web et accédez à l'application.

- Le menu de connexion devrait apparaître.


### 5. Connexion à l'application

Vous pouvez maintenant vous connecter en utilisant l'un des identifiants suivants :

| Identifiant                  | Mot de passe  |
|------------------------------|---------------|
| visiteur@vigsb.fr             | visiteur      |
| delegueregional@vigsb.fr      | region        |
| secteur@vigsb.fr              | secteur       |

---

Si vous avez des questions ou des problèmes lors de l'installation, n'hésitez pas à consulter la documentation ou à me contacter via GitHub.
