<?php
 // Login to the database
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tp_blog;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$name = addslashes(strip_tags($_POST['name']));
$comments = addslashes(strip_tags($_POST['comments']));
$billet_id = $_GET['billet'];
// Inserting the message using a prepared query
if(!empty($name) AND !empty($comments)){
 $req = $bdd->exec("INSERT INTO comment (name, comments, billet_id ) VALUES ('$name', '$comments', '$billet_id')");
}
  // Redirecting the visitor to the minichat page
  header('location: commentaires.php?billet=' . $billet_id . '');
?>
