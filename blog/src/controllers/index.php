<?php

   #Ceci est un controlleur (il relie un modèle
   # et une vue)

   #On appelle le modèle (qui réalise la connexion
   #à la base de données et gère les requêtes)
   
   require('src/model/post.php');


   #On utilise la fonction getPosts de model.php
   #et on la stocke dans la variable $posts

   $posts = getPosts();

   #On appelle le template de la homepage
   #(qui est une vue)

   require('templates/homepage.php');


# NOTE IMPORTANTE :
#Il est recommendé d'enlever la balise fermante (? >) pour les 
#fichiers contenant uniquement du PHP

#Cela permet d'éviter que ces fichiers n'envoient par erreur 
#du code HTML sous forme d'espaces blancs alors qu'ils ne 
#devraient pas
