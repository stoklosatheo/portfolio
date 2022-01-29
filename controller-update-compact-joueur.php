<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

include('include/equipe_type-php.php');

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Soit on affiche le formulaire soit on traite les données recu
if (isset($_POST['nom_joueuret'])){
    // L'utilisateur a envoyé des données donc on traite les données
    //On initialise la variable qui affiche les message d'infi
    $message=[];

    // Construction d'un tableau associatif à partir du post
    $joueuret=transform_post_joueuret($_POST);
        // On sauvegarde le tableau associatif de la voiture 
        update_joueuret($pdo, $joueuret);

        if (!isset($message['texte'])){
            $message['classe'] = "success";
            $message['texte'] = 'Le joueur a bien été modifié';
        }

        // On affiche le formulaire
        echo $twig->render('view-update-form-joueur.twig', [
            'joueuret' => $joueuret,
            'message' => $message
        ]);
}
else{
    // L'utilisateur n'a pas envoyé le formulaire donc on affiche le formulaire
    // Récupère les données GET sur l'URL
    if (isset($_GET['id'])) $id = $_GET['id'];
    $id = intval($id);

    // Récupère les données
    $joueuret = select_joueur_byid($pdo, $id);

    // On affiche le formulaire
    echo $twig->render('view-update-form-joueur.twig', [
        'joueuret' => $joueuret
    ]);
}