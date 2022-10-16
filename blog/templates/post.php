<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Le titre pour le layout-->
    <?php $title = "Le blog de l'AVBN"; ?>

    <link href="style.css" rel="stylesheet" />
</head>

<body>


    <!--Capture de la variable "content" pour le layout-->
    <?php ob_start(); ?>

    <h1>Le super blog de l'AVBN</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?= htmlspecialchars($post->title) ?>
            <em>le <?= $post->frenchCreationDate ?> </em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post->content)) ?>
        </p>
    </div>


    <h2>Commentaires</h2>

    <?php
        foreach ($comments as $comment) {
    ?>

        <!--   -> = POO ($comment->author  par exemple)-->

        <p><strong> <?= htmlspecialchars($comment->author) ?> </strong>
        le <?= $comment->frenchCreationDate ?>

        (<a href="index.php?action=updateComment&id=<?= urlencode($comment->identifier)?>&post_id=<?= $comment->post; ?>">Modifier</a>)
        </p>

        <p><?= nl2br(htmlspecialchars($comment->comment)) ?></p>

    <?php 
    }
    ?>

    <?php $content = ob_get_clean(); ?>

    <?php require('layout.php'); ?>


    <h2>Formulaire de création de commentaires</h2>

    <form action="index.php?action=addComment&id=<?= $post->identifier ?>" method="post">

        <div>
            <label for="author">Auteur</label>
            <input type="text" id="author" name="author">
        </div>
        <div>
            <label for="comment">Commentaire</label>
            <input type="text" id="comment" name="comment">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>

</body>
</html>