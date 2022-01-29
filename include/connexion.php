<?php

function connexion()
{
  $pdo = new PDO('mysql:localhost;dbname=stoklosa_info3_blog;charset=utf8', 'stoklosa', 'ManCity1894');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  if ($pdo) {
    return $pdo;
    echo '<p>Connexion réussie</p>';
  } else {
    echo '<p>Erreur de connexion</p>';
    exit;
  }
}

?>