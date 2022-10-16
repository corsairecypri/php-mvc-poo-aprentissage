<?php

/*Ne pas oublier d'ajouter le lien vers le controleur quand on a créé une nouvelle route */

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/update.php');


use Application\Controllers\Add\AddComment;
use Application\Controllers\UpdateComment;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;


/* Pour que ce controlleur fonctionne, on a 4 choix

    1) taper index.php (et ça affichera la homepage)

    2) taper index.php?action=post&&id=<l'id de votre choix>

    3) Utiliser le formulaire de la page "templates/post.php"

    4) Mettre à jour un commentaire 

*/

/* Pour la 1ère route vérifiée (celle du choix 2)

On vérifie d'abord si le paramètre 'action' existe et n'est pas vide

Puis on vérifie qu'il valle 'post' 

Et enfin on vérifie que le paramètre 'id' existe et est > à 0
*/


try {

    ### La route du choix 2

    if (isset($_GET['action']) && $_GET['action'] !== ''){

        if ($_GET['action'] === 'post') {

            if(isset($_GET['id']) && $_GET['id'] > 0) {

                $identifier = $_GET['id'];

                post($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        ### La route du formulaire (choix 3)

        } elseif ($_GET['action'] === 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0){

                $identifier = $_GET['id'];

                addComment($identifier, $_POST);
                
            } else { 
                throw new Exception('Aucun identifiant de billet envoyé');
            }

            #Mise à jour d'un commentaire (choix 4)

        } elseif ($_GET['action'] === 'updateComment') { 
            
            if (isset($_GET['id']) && $_GET['id'] > 0){

                $identifier = $_GET['id'];

                #Initier $ avec la valeur de $_POST si la méthode
                #utilisée est POST

                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                update($identifier, $input);
                
            } else { 
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        } 

    } else {
        # La route de la homepage (choix 1)

        homepage();
    }

} catch (Exception $e){
    echo 'Erreur : '.$e->getMessage();
}