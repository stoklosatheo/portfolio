<?php

function select_joueurs($pdo)
{
  // construction de la requête
  $sql =  'select * from Joueurs';

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

function select_gardiens($pdo){
    // construction de la requête
    $sql =  'select * from Joueurs Where poste_joueur="Gardien"';

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

function select_defenseurs($pdo){
  // construction de la requête
  $sql =  'select * from Joueurs Where poste_joueur="Defenseur"';

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

function select_milieux($pdo){
  // construction de la requête
  $sql =  'select * from Joueurs Where poste_joueur="Milieu"';

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

function select_attaquants($pdo){
  // construction de la requête
  $sql =  'select * from Joueurs Where poste_joueur="Attaquant"';

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