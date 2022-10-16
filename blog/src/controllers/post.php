<!--NOTE IMPORTANTE : ce post.php est un contrôleur qui
gère les infos du template post.php-->

<?php


#Un namespace permet d'éviter les conflits entre 2
#fonctions qui posséderaient le même nom

#En ajoutant PostReposirory au namespace,
#je précise que PostRepository peut être 
#utilisé comme un alias à  Application\Model\Post\

use Application\Model\Post\PostRepository;
use Application\Model\Comment\CommentRepository;



require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');



function post(string $identifier)
{

    /*On réalise la connection à la db avec un objet
    de la classe DatabaseConnection */

    $connection = new DatabaseConnection();


    /* 1) On crée un objet de la classe PostRepository
    pour stocker la connexion */

   $postRepository = new PostRepository();

    /* 2) On demande à l'objet postRepository de
    se connecter à la base de données */

   $postRepository->connection = $connection;

    /* 3) On utilise la méthode getPost de la classe
    postRepository */

   $post = $postRepository->getPost($identifier);

    /*On refait ces 3 étapes avec un objet de classe
    CommentRepository */

   $commentRepository = new CommentRepository();

   $commentRepository->connection = $connection;

   $comments = $commentRepository->getComments($identifier);
    
   
   require('templates/post.php');
}