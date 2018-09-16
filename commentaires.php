<!DOCTYPE html>

<html>

    <head>
      <meta charset="utf-8">
       <meta http-equiv="x-ua-compatible" content="ie=edge">
       <title>Mon Blog</title>
       <meta name="description" content="">
       <link rel="manifest" href="site.webmanifest">
       <link rel="apple-touch-icon" href="icon.png">
       <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800" rel="stylesheet">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <link rel="stylesheet" href="css/main.css">
       <link rel="stylesheet" href="css/normalize.css">


    </head>



    <body>

        <h1>Mon super blog !</h1>

        <p><a href="index.php">Retour à la liste des billets</a></p>



<?php

// Connection to the database

try

{

    $bdd = new PDO('mysql:host=localhost;dbname=tp_blog;charset=utf8', 'root', '');

}

catch(Exception $e)

{

        die('Erreur : '.$e->getMessage());

}


// Ticket recovery

$req = $bdd->prepare("SELECT id, title, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss')
AS date_creation_fr FROM billet WHERE id = ?");
// Inserting the message using a prepared query

$req->execute(array($_GET['billet']));

$donnees = $req->fetch();

?>


<div class="news">

    <h3>

        <?php echo htmlspecialchars($donnees['title']); ?>

        <em>le <?php echo $donnees['date_creation_fr']; ?></em>

    </h3>



    <p>

    <?php

    echo nl2br(htmlspecialchars($donnees['contenu']));

    ?>

    </p>

</div>


<h2>Commentaires</h2>


<?php

$req->closeCursor();


// Retrieving comments

$req = $bdd->prepare("SELECT name, comments') FROM comment WHERE id_billet = ?");

$req->execute(array($_GET['billet']));


while ($donnees = $req->fetch())

{

?>

<p><strong><?php echo htmlspecialchars($donnees['name']); ?></strong> le <?php echo $donnees['date_comment_fr']; ?></p>

<p><?php echo nl2br(htmlspecialchars($donnees['comments'])); ?></p>

<?php

} //End of the feedback loop

$req->closeCursor();
?>
<?php

  // <!-- Retrieve the last 10 messages -->
  $reponse = $bdd->prepare('SELECT * FROM comment WHERE billet_id=? ORDER BY ID DESC LIMIT 10');
  $reponse->execute(array($_GET['billet']));
  // <!-- Display of each message (all data is protected by htmlspecialchars) -->
  while ($donnees = $reponse->fetch()) {
    echo '<p><strong>' . htmlspecialchars($donnees['name']).  '</strong>  : ' . htmlspecialchars($donnees['comments']) . '</p>';
  }
 $reponse->closecursor();

echo '<form  action="commentaires_post.php?billet=' . $_GET['billet'] . '" method="post">
<label for="auteur">Pseudo : </lable> <input type="text" name="name" ><br>
<label for="commentaire">comment : </label><input type="text" name="comments"  ></br>
<input  type="submit" value="Envoyer">
</form>';
?>

</body>

</html>
