<?php
// Initialise Twig
include('include/twig.php');
$twig = init_twig();

include('include/equipe_type-php.php');

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

//O n affiche le formulaire
echo $twig->render('view_insert_form_joueur.twig', []);