<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

include('include/equipe_type-php.php');

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Soit on affiche le formulaire soit on traite les données récupérées
if (isset($_POST['nom_joueuret'])) {
    // L'utilisateur a envoyé des données donc on traite les données
    //On initialise la variable qui affiche les message d'infi
    $message=[];

    // Construction d'un tableau associatif à partir du post
    $joueuret=transform_post_joueuret();

    //On sauvegarde le tableau associatif de la voiture 
    update_joueuret($pdo, $joueuret);

    if (!isset($message['texte'])){
        echo '<p class="alert alert-success">Le joueur a bien été modifié</p>';
    }

    //On affiche le formulaire
    echo $twig->render('view_update_validation_joueuret.twig', [
        'joueuret' => $joueuret,
    ]);
}
