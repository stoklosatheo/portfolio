<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données
include('include/Equipe-php.php');
$joueurs = select_joueurs($pdo);
$gardiens = select_gardiens($pdo);
$defenseurs = select_defenseurs($pdo);
$milieux = select_milieux($pdo);
$attaquants = select_attaquants($pdo);


// Lancement du moteur Twig avec les données
echo $twig->render('Equipe.twig', [
    'joueurs' => $joueurs,
    'gardiens' => $gardiens,
    'defenseurs' => $defenseurs,
    'milieux' => $milieux,
    'attaquants' => $attaquants
    ]);

?>

