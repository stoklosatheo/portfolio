<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données
include('include/equipe_type-php.php');
$equipe_type = select_equipe_type($pdo);

// Lancement du moteur Twig avec les données
echo $twig->render('equipe_type.twig', [
    'equipe_type' => $equipe_type
    ]);

?>

