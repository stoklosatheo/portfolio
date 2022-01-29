<?php

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données
include('include/resultats-php.php');
$resultats = select_resultats($pdo);
$titulaire = select_titulaire($pdo);

// Lancement du moteur Twig avec les données
echo $twig->render('resultats.twig', [
    'resultats' => $resultats,
    'titulaire' => $titulaire
    ]);

?>

