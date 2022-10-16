<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $title = "Le blog de l'AVBN"; ?>
</head>
<body>

<?php ob_start(); ?>

    <h1>Le super blog de l'AVBN !</h1>
    <p><a href="index.php?action=post&id=<?= $comment->post ?>">Retour au billet</a></p>
    

    <h2>Formulaire de modification de commentaires</h2>

    <!--Pour revenir vers la page des billets, il fallait mettre comment->post (comme en haut)
    et non comment->identifier comme j'ai essayé de le faire de manière intuitive-->

    <form action="index.php?action=updateComment&id=<?= $comment->identifier ?>&post_id=<?= $comment->post ?>" method="post">

        <div>
            <label for="author">Auteur</label>
            <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment->author)?>">
        </div>
        <div>
            <label for="comment">Commentaire</label>
            <textarea type="text" id="comment" name="comment" value="<?= htmlspecialchars($comment->comment) ?>"></textarea>
        </div>
        <div>
            <input type="submit">
        </div>
    </form>

<?php $content = ob_get_clean(); ?>


<?php require('layout.php') ?>

</body>
</html>