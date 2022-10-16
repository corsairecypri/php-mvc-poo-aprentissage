<?php 
use Application\Model\Post\PostRepository;

/*Un controlleur appelle la liste des fonctions disponibles (qui sont dans model.php) */

require_once('src/model/post.php');

require_once('src/lib/database.php');

/*Puis au sein d'une fonction, il appelle la fonction de model.php dont il
a besoin, ainsi que le template nécessaire */

function homepage() {

    #Cet objet de classe PostRepository permet
    #d'instancier la connexion à la db

    $postRepository = new PostRepository();

    $postRepository->connection = new DatabaseConnection();

    $posts = $postRepository->getPosts();

    require('templates/homepage.php');
}