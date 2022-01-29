<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Accueil</title>
</head>
<body>
<header>
    <?php
        // Chargement des données exemples
        include('include/Projet_data.php');

        include('include/twig.php');

        // Génération du code HTML en PHP à partir des variables
        
        echo 
            '<h1>' .$titre. '</h1>
        
            <h2>' .$texte. '</h2>'
        ;
        

        $twig = init_twig();
        echo $twig->render('accueil.twig', [

            ]);
        ?>   
</header>
</body>
</html>

