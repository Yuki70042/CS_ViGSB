L'application vigsb est une application réalisé dans le cadre de mon BTS SIO option SLAM en seconde année.
L'objectif est de développer un logiciel foncitonnel dans un cadre d'entreprise contenant l'ensemble des pratiques nécessaires.


Afin d'installer cette application :

1. Débuter par installer XAMP sur votre ordinateur : https://www.apachefriends.org/fr/download.html
   Et lancer l'application ainsi que ses modules "Apache" ainsi que "MySQL"
   
2. Importer le code source de ce projet sur votre IDE via github en réalisant un pull de la branche "master"
3. Dans la console de votre projet, exécuter la commande : php install.php
   Cela importera la base de donnée initiale "vigsb" dans PHPmyAdmin  (visible en cliquant sur "Admin" ->module MySQL
4. Lancer L'application sur un navigateur, et le menu de connexion devrait s'afficher.

   Vous pouvez maintenant vous connecter en utilisant l'un des 3 rôles suivants :

---------------------------------------------------

   identifiant:                 mot de passe :

   visiteur@vigsb.fr            visiteur
   delegueregional@vigsb.f      region
   secteur@vigsb.fr             secteur
