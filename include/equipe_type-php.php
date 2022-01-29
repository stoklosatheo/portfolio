<?php

function select_equipe_type($pdo)
{
  // construction de la requête
  $sql =  'select * from equipe_type';

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

function transform_post_joueuret() {
  $joueuret = ['id_joueur'=>'', 'nom_joueur'=>'', 'poste_joueur' => '', 'photo_joueur' => ''];

  // Pour chaque élément du formulaire, on récupère la valeur saisie si elle existe
  if (isset($_POST['id_joueuret'])) {
    $joueuret['id_joueur'] = $_POST['id_joueuret'];
  }
  if (isset($_POST['nom_joueuret'])) {
    $joueuret['nom_joueur'] = $_POST['nom_joueuret'];
  }
  if (isset($_POST['poste_joueuret'])) {
    $joueuret['poste_joueur'] = $_POST['poste_joueuret'];
  }
  if (isset($_POST['photo_joueuret'])) {
    $joueuret['photo_joueur'] = $_POST['photo_joueuret'];
  }


  // On retourne les données réceptionnées
  return $joueuret;
}

function insert_joueuret($pdo, $joueuret){
  // Construction et préparation de la requête
  $sql = 'insert into equipe_type (nom_joueur, poste_joueur, photo_joueur) values (:nom_joueur, :poste_joueur, :photo_joueur)';
  $query = $pdo->prepare($sql);
 
  // Assignation des valeurs à partir du tableau
  $query->bindValue(':nom_joueur', $joueuret['nom_joueur'], PDO::PARAM_STR);
  $query->bindValue(':poste_joueur', $joueuret['poste_joueur'], PDO::PARAM_STR);
  $query->bindValue(':photo_joueur', $joueuret['photo_joueur'], PDO::PARAM_STR);

  // Exécution de la requête
  $query->execute();
}

function delete_joueuret($pdo, $id){
  // Construction et préparation de la requête
  $sql = 'DELETE FROM equipe_type WHERE id_joueur = :id_joueur';
  $query = $pdo->prepare($sql);
 
  // On utilise $isbn pour fixer la valeur de la clé
  $query->bindValue(':id_joueur', $id, PDO::PARAM_INT);
 
  // Exécution de la requête
  $query->execute();    
}

function select_joueur_byid($pdo, $id)
{
    // Construction de la requête
    $sql = 'select * from equipe_type where id_joueur = :id';

    // Exécution de la requête
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();

    if ($query->errorCode() == '00000') {
        // Récupération des données dans un tableau
        $results = $query->fetch(PDO::FETCH_OBJ);
    } else {
        $errors = $query->errorInfo();
        $errors = (isset($errors[2])) ? $errors[2] : 'Une erreur est survenue, merci de recommencer.';
        echo '<p>Erreur dans la requête : ' . $errors . '</p>';
        $results = null;
    }

    return $results;
}

function update_joueuret($pdo, $joueuret){
  // Construction et préparation de la requête
  $sql = 'update equipe_type set id_joueur = :id_joueur , nom_joueur = :nom_joueur , poste_joueur = :poste_joueur, photo_joueur = :photo_joueur where id_joueur = :id_joueur;';
  $query = $pdo->prepare($sql);

  // Assignation des valeurs à partir du tableau $auteur
  $query->bindValue(':id_joueur', $joueuret['id_joueur'], PDO::PARAM_INT);
  $query->bindValue(':nom_joueur', $joueuret['nom_joueur'], PDO::PARAM_STR);
  $query->bindValue(':poste_joueur', $joueuret['poste_joueur'], PDO::PARAM_STR);
  $query->bindValue(':photo_joueur', $joueuret['photo_joueur'], PDO::PARAM_STR);

  // Exécution de la requête
  $query->execute();
}
?>