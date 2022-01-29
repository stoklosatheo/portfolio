<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupère les données GET sur l'URL
if (isset($_GET['id'])) $id = $_GET['id'];
$id = intval($id);

// Récupère les données
include('include/equipe_type-php.php');
$joueuret = select_joueur_byid($pdo, $id);

// Lance le moteur de rendu Twig avec les données
echo $twig->render('view-select-joueur-byid.twig', [
    'joueuret' => $joueuret
]);