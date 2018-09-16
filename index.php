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

        <h1>Mon blog !</h1>

        <p>Derniers billets du blog :</p>



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


            // We recover the last 5 tickets

$req = $bdd->query("SELECT id, title, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss')
AS date_creation_fr FROM billet ORDER BY date_creation DESC LIMIT 0, 5");

            while ($donnees = $req->fetch())

            {

            ?>

            <div class="news">

                <h3>

                    <?php echo htmlspecialchars($donnees['title']); ?>

                    <em>le <?php echo $donnees['date_creation_fr']; ?></em>

                </h3>



                <p>

                <?php

                // On affiche le contenu du billet

                echo nl2br(htmlspecialchars($donnees['contenu']));

                ?>

                <br />

                <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>

                </p>

            </div>

            <?php

            } // Fin de la boucle des billets

            $req->closeCursor();

            ?>


 </body>

</html>
