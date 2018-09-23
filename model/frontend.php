<?php
function getPosts()
{
    $bdd = dbConnect();
    $req = $bdd->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5");

    return $req;
}

function getPost($postId)
{
    $bdd = dbConnect();
    $req = $bdd->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts WHERE id = ?");
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $bdd = dbConnect();
    $comments = $bdd->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $bdd = dbConnect();
    $comments = $bdd->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
}


// Nouvelle fonction qui nous permet d'éviter de répéter du code
function dbConnect()
{
  // Login to the database
  include("../password1/password.php");

      $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', $password);
       return $bdd;
}
