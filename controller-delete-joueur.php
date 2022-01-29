<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupère les données GET sur l'URL
$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Transforme l'id en entier
    $id = intval($id);
}

// Récupération des données
include('include/equipe_type-php.php');
delete_joueuret($pdo, $id);

// Récupère la liste de toutes les joueurs
$joueuret = select_equipe_type($pdo);

// Lancement du moteur Twig avec les données
echo $twig->render('equipe_type.twig', [
    'joueuret' => $joueuret
]);