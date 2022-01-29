<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

include('include/equipe_type-php.php');

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupère les données GET sur l'URL
if (isset($_GET['id'])) $id = $_GET['id'];
$id = intval($id);

// Récupération des données
$joueuret = select_joueur_byid($pdo, $id);

// On affiche le formulaire
echo $twig->render('view-update-form-joueur.twig', [
    'joueuret' => $joueuret
]);
