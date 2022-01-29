<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

include('include/equipe_type-php.php');

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

$message = [];

// Construction d'un tableau associatif à partir du post
$joueuret=transform_post_joueuret();
    
// On sauvegarde le tableau associatif de la voiture 
insert_joueuret($pdo, $joueuret);

if (!isset($message['texte'])){
    echo '<p class="alert alert-success">Le joueur a bien été ajouté</p>';
}

// On affiche le formulaire
echo $twig->render('view_update_validation_joueuret.twig', [
    'joueuret' => $joueuret,
]);
