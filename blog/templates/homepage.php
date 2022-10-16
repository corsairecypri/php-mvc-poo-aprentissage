<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      
      <!--On donne la variable $title pour combler
      le 1er trou du layout-->
      <?php $title = "Le blog de l'AVBN"; ?>

      <link href="style.css" rel="stylesheet" />
   </head>

   <body>

      <!--La fonction ob_start() permet de commencer la capture
      d'une grosse partie de code pour un "trou" du layout-->

      <?php ob_start(); ?>

         <h1>Le super blog de l'AVBN !</h1>
         <p>Derniers billets du blog :</p>

         <?php
            foreach ($posts as $post) {
         ?>

            <div class="news">
               <h3>
                  <!--On utilise des "short echo tags" (on ne les utilise que dans les templates).
                  Quand on affiche qu'une variable, on peut ommettre le "echo" en écrivant
                  < + ?=  à la place de < + ?php echo
                  -->

                  <?= htmlspecialchars($post->title); ?>
                  <em>le <?= $post->frenchCreationDate; ?></em>
               </h3>
               <p>
                  <!-- We display the post content -->

                  <?= nl2br(htmlspecialchars($post->content)); ?>

                  <br>

                  <!--Le lien renvoie vers post.php et récupère l'id
                  avec la méthode GET en utilisant la propriété identifier-->
                  
                  <em><a href="index.php?action=post&id=<?= urlencode($post->identifier)?>">Commentaires</a></em>
               </p>
            </div>
         <?php
         }  // The end of the posts loop.
         ?>

       <!--La fonctionn ob_get_clean() permet de terminer
       la capture du gros morceau de code pour le trou du
       layout (et on le stocke dans la variable $content)-->

      <?php $content = ob_get_clean(); ?>

      <!--Ne pas oublier l'appel du layout-->

      <?php require('layout.php') ?>
      
   </body>
</html>
