
# Site de gestion des plannings

## Présentation du Site


<p> <strong> Le site permet de gérer les plannings dans une formation, il comporte 3 acteurs : </strong></p>
<ul>
<li>Les étudiants : ils peuvent s’inscrire pour des cours de leur formation et voir leur planning personnalisé.
</li>
<li>Les enseignants : Ils sont responsables du cours et peuvent déplacer ou créer des séances (entrées) dans le planning. Il
peuvent également voir leur planning personnalisé.</li>
 <li>L’administrateur : Il fait les tâches de gestion – création/modification des cours, formations, enseignants et étudiants. Il
peut également faire toutes les tâches des étudiants et des enseignants, ainsi que voir le planning pour tout le monde.</li>
 </ul>
 
## Fonctionnalités
<ol>
    <li>
       <strong>les étudiants : </strong></li>
    
<ul>
 <li> Voir la liste des cours de la formation (dans laquelle l’étudiant est inscrit).
   
 </li>
   
 <li>Gestion des inscriptions :
    <ul> 
      <li>Inscription dans un cours</li>
      <li>Désinscription d’un cours</li>
      <li>Liste des cours auxquels l’étudiant est inscrit</li>
      <li>Rechercher un cours dans la liste des cours de la formation</li> 

   </ul> 
   
   
 </li>

 <li> Affichage du planning personnalisé (uniquement les séances des cours auxquels cet étudiant est inscrit) :

  <ul> 
      <li>Intégral</li>
      <li>Par cours</li>
      <li>Par semaine</li>


   </ul>  
   </li>
      
 </ul>
 </br>
 <li><strong> Les enseignants : </strong></li>
 <ul>
    <li>Voir la liste des cours dont on est responsable</li>
 <li> Voir le planning personnalisé (les séances dont on est responsable) :

  <ul> 
      <li>Intégral</li>
      <li>Par cours</li>
      <li>Par semaine</li>


   </ul>  
 </li> 
 <li> Gestion du planning :

   <ul> 
      <li>Création d’une nouvelle séance de cours</li>
      <li>Mise à jour d’une séance de cours.</li>
      <li>Suppression d’une séance de cours</li>
      <li>Utilisation 2 vues différentes pour les opérations ci-dessus (par cours et par semaine)</li>


   </ul>  
 </li> 
  <li><strong> Pour l’utilisateur (étudiant ou enseignant) : </strong></li>
      <ul> 
      <li>Création du compte</li>
      <li>Changement de son mot de passe</li>
      <li>Modification du nom/prénom</li>


   </ul> 

   </ul>
   </br>
 <li><strong> L’administrateur : </strong></li>
 <ul>
 
 <li> Gestion des utilisateurs :
    <ul> 
 <li>Liste :
    <ul> 
      <li>Intégrale</li>
      <li>Filtre par type (étudiant/enseignant)</li>
      <li>Recherche par nom/prénom/login</li>

   </ul> 
   
   
 </li>
      <li>Acceptation (ou refus) d’un utilisateur qui a été auto-crée</li>
      <li>Association d’un enseignant à un cours</li>
      <li>Création d’un utilisateur</li>
      <li>Modification d’un utilisateur (y compris le type)</li>
      <li>Suppression d’un utilisateur</li>
        
      
   </ul>    
 </li>
 
 <li> Gestion des cours :
    <ul> 
      <li>Liste</li>
      <li>Recherche par intitulé</li>
      <li>Création d’un cours</li>
      <li>Modification d’un cours</li>
      <li>Suppression d’un cours</li>
     <li>Association d’un enseignant à un cours</li>
     <li>Liste des cours par enseignant (pour n’importe quel enseignant)</li>
   </ul>   
    
 </li>
 
  <li> Gestion des formations :
    <ul> 
      <li>Liste</li>
      <li>Ajout d’une formation</li>
      <li>Modification d’une formation</li> 
      <li>Supression d’une formation</li>
   </ul>   
    
 </li>
 
   <li> Gestion du planning :
    <ul> 
      <li>Création d’une nouvelle séance de cours(pour n’importe quel enseignant)</li>
      <li>Mise à jour d’une séance de cours(pour n’importe quel enseignant)</li>
      <li>Suppression d’une séance de cours(pour n’importe quel enseignant)</li> 
      <li>Utiliser 2 vues différentes pour les opérations ci-dessus (par cours et par semaine)</li>
   </ul>   
    
 </li>



</ul>
 
 
 </ol>
 </br>
 
 ## Notes :
<ul>
    <li>Pour simplifier le projet, il existe un seul endroit qui stocke les identifiants des acteurs (la table users). Par conséquent il
faut vérifier le type pour les discriminer, afficher les bonnes pages et vérifier les droits. </li> 
    <li>Le compte administrateur (admin:admin) est précrée dans la base initiale.</li>
    <li>Pour créer un compte la procédure est la suivante : l’utilisateur remplit le formulaire en indiquant entre autre sa
formation (pour les enseignants et les admins – un item spécial serait utilisé). Ces informations seront inscrits dans la
table users (avec le type égal à null). Ensuite, l’administrateur valide cette demande et maj le type. Donc un type=null
indique que l’utilisateur est inactive et ne peut pas encore accéder au site. </li> 
    <li>Pour un enseignant ou admin le champs formation_id sera null.</li>
    <li>Un admin peut contourner la procédure ci-dessus, en créant directement un enregistrement.</li> 
    <li>Afin de mieux tester les différents cas d’utilisation, utilisez des Seeders pour remplir la BD avec des données factices.</li>
    <li>La base de données suit les conventions de nommage de Laravel (excepté le cours).</li> 
 </ul>

<br/>
 
## Base de données :
<ul>
    <li>users (id,nom,prenom,login,mdp,formation_id,type)
</li> 
    <li>formations(id,intitule,created_at,updated_at)
</li>
    <li>cours(id,intitule,user_id,formation_id,created_at,updated_at)
</li>
    <li>cours_users(cours_id,user_id)</li>
    </li>
    <li>plannings(id,cours_id,date_debut,date_fin)</li>
 </ul>

<br/>

## Utilisation :
<ol>
    <li><bold>Clone the Repository:</bold></li>
    <ul>
        <li>Open your terminal.</li>
        <li>Run the command: <code>git clone https://github.com/ZuuXs/Planning-site.git</code></li>
    </ul>
    <li><bold>Navigate to the Project Directory:</bold></li>
    <ul>
        <li>Change directory to the cloned repository: <code>cd Planning-site</code></li>
    </ul>
    <li><bold>Install Dependencies:</bold></li>
    <ul>
        <li>Run the command: <code>composer install</code></li>
    </ul>
    <li><bold>Setup Environment Configuration:</bold></li>
    <ul>
        <li>Copy the example environment file: <code>cp .env.example .env</code></li>
        <li>Generate the application key: <code>php artisan key:generate</code></li>
        <li>Update the <code>.env</code> file with your database credentials and other configurations.</li>
    </ul>
    <li><bold>Migrate the Database:</bold></li>
    <ul>
        <li>Run the migrations to create the database tables: <code>php artisan migrate</code></li>
    </ul>
    <li><bold>Run the Application:</bold></li>
    <ul>
        <li>Start the development server: <code>php artisan serve</code></li>
    </ul>
    <li><bold>Access the Application:</bold></li>
    <ul>
        <li>Open your web browser and go to: <code>http://localhost:8000</code></li>
    </ul>
</ol>
