<?php

function select_resultats($pdo)
{
  // construction de la requête
  $sql =  'select * from resultats';

  // exécution de la requête
  $query = $pdo->prepare($sql);

  $query->execute();

  if ($query->errorCode() == '00000') {
    // récupération des données dans un tableau
    $tableau = $query->fetchAll(PDO::FETCH_OBJ);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  return $tableau;
}

function select_titulaire($pdo){
  $sql = 'select resultats.id_journee , nom_joueur , Joueurs.id_journee FROM resultats 
  INNER JOIN Joueurs ON resultats.id_joueur = Joueurs.id_joueur 
  WHERE Joueurs.id_journee = resultats.id_journee';

  // exécution de la requête
  $query = $pdo->prepare($sql);
  $query->execute();

  if ($query->errorCode() == '00000') {
    // récupération des données dans un tableau
    $tableau = $query->fetchAll(PDO::FETCH_OBJ);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  return $tableau;
}

?>