<?php


namespace Application\Model\Post;

#####Création de classes (et de méthodes) sur les posts

#On appelle le fichier de la classe permettant de créer une
#connexion à la base de données

require_once('src/lib/database.php');


class Post 
{
   public string $title;
   public string $frenchCreationDate;
   public string $content;
   public string $identifier;
}

#Note : la composition est le fait d'utiliser un objet à l'intérieur d'un autre objet
#(Par exemple : à l'intérieur de la classe PostRepository, on crée un objet de classe
#DatabaseConnection pour gérer les connexions à la database)

class PostRepository
{
   
   #On crée une instance de la classe DatabaseConnection
   #à laquelle on ajoute une propriété $connection (qui permet d'appeler l'instance)

   public \DatabaseConnection $connection;


   /*Une fonction à l'intérieur d'une classe 
   s'appelle une méthode */

   public function getPost(string $identifier): Post
   {

      $statement = $this->connection->getConnection()->prepare(
         "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS 
         french_creation_date FROM posts WHERE id = ?"
      );

      $statement->execute([$identifier]);
      $row = $statement->fetch();

      $post = new Post();
      $post->title = $row['title'];
      $post->frenchCreationDate = $row['french_creation_date'];
      $post->content = $row['content'];
      $post->identifier = $row['id'];

      return $post;
   }

   /*Attention notez le "s" du pluriel  */

   public function getPosts(): array {

      // On récupère les 5 derniers billets
      
      $statement = $this->connection->getConnection()->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS
         french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
   
      $posts = [];
      while (($row = $statement->fetch())) {
         $post = new Post();
         $post->title = $row['title'];
         $post->frenchCreationDate = $row['french_creation_date'];
         $post->content = $row['content'];
         $post->identifier = $row['id'];
   
         $posts[] = $post;
      }
   
      return $posts;
   
   }
     
}



# Ommision de la balise fermente
#(voir index.php pour les explications)