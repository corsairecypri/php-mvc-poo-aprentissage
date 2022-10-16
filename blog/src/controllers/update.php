<?php
use Application\Model\Comment\CommentRepository;

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/post.php');



function update(string $identifier, ?array $input )
{
    #Cette fonction gère le formulaire de modification quand il y a un input

    if ($input !== null) {

        $author = null;
        $comment = null;

        if (!empty($input['author']) && !empty($input['comment'])) {
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $success = $commentRepository->updateComment($identifier, $author, $comment);
        
        
        

        if (!$success) {
            throw new \Exception('Impossible de modifier le commentaire !');
        } else {
             header('Location: index.php');
        }

    }
    
    #Autrement, cette fonction présente le formulaire
    
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $comment = $commentRepository->getComment($identifier);
    if ($comment === null) {
        throw new \Exception("Le commentaire $identifier n'existe pas.");
    }

    require('templates/update_comment.php');
}
