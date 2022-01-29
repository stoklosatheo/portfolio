<?php

include('include/connexion.php');
include('include/ecusson.php');
include('include/twig.php');
include('include/article.php');

$twig = init_twig();

// Analyse des variables sur l'URL qui définissent la route (page/action/id)
// Les 3 variables $page, $action, $id sont définies

// Récupération de la variable page sur l'URL
if (isset($_GET['page'])) $page = $_GET['page']; else $page = '';

// Récupération de la variable action sur l'URL
if (isset($_GET['action'])) $action = $_GET['action']; else $action = 'read';

// Récupération de l'id s'il existe (par convention la clé 0 correspond à un id inexistant)
if (isset($_GET['id'])) $id = intval($_GET['id']); else $id = 0;

/* Le contrôleur analyse la requête ou la route (ici la page à visualiser)
 * En fonction de la page choisie, il
 * - détermine la vue à utiliser dans la variable $view
 * - fait appel au modèle pour récupérer les données dans la variable $data
 */
switch ($page) {
	case 'article' :
		switch ($action) {
			case 'read' :
				// Affiche l'article dont l'id est sur l'URL
				// Utilise la vue article simple avec un message
				$view = 'article.twig';
				$data = [
					// La requête readOne récupère les données à afficher
					'article' => Article::readOne($id),
					'message' => 'Détails de l\'article'
				];
				break;
			case 'create' :
				// Création d'un article (vide)
				$article = new Article();
				// Récupère les données envoyées par le formulaire (POST)
				$article->chargePOST();
				// Requête de création de l'article
				$article->create();
				// Utilise la vue article simple avec un message
				$view = 'article.twig';
				$data = [
					'article' => $article,
					'message' => 'article créé'
				];
				break;
			case 'edit' :
				// Modification d'un article : étape 1 => affiche l'article dans un formulaire
				$view = 'edit_article.twig';
				// L'article à modifier est récupéré avec la requête readOne
				$data = ['article' => Article::readOne($id)];
				break;
			case 'update' :
				// Modification d'un article : étape 2 => met à jour la base de données
				// Création d'un article (vide)
				$article = new Article();
				// Récupère les données du formulaire = l'article modifié
				$article->chargePOST();
				// Réquête de mise à jour
				$article->update();
				// Utilise la vue article simple avec un message
				$view = 'article.twig';
				$data = [
					'article' => $article,
					'message' => 'article modifié'
				];
				break;
			case 'delete' :
				// Récupération de l'article pour l'afficher avant la suppression
				$article = Article::readOne($id);
				// Supression de l'article
				Article::delete($id);
				// Utilise la vue article simple avec un message
				$view = 'article.twig';
				$data = [
					'article' => $article,
					'message' => 'Suppression de l\'article'
				];
				break;
			default :
				// Page vide ou page d'erreur
				$view = 'articles.twig';
				$data = [];
		}
		break;
		case 'ecusson' :
			switch ($action) {
				case 'read' :
					// Affiche l'article dont l'id est sur l'URL
					// Utilise la vue article simple avec un message
					$view = 'base.twig';
					$data = [
						// La requête readOne récupère les données à afficher
						'ecusson' => Ecusson::readAll($id),
						'message' => 'Détails de l\'article'
					];
					break;
			}
			break;
	case 'form_article' :
		// Page affichant un formulaire de saisie d'un nouvel article
		// Pourrait aussi être une action de la page article
		$view = 'form_article.twig';
		$data = [];
		break;
	case 'init' :
		// Page spéciale pour réinitialiser la base de données
		Article::init();
	case 'articles' :
	default :
		// La page d'accueil affiche tous les articles
		$view = 'articles.twig';
		$data = ['articles' => Article::readAll()];
}

// Le contrôleur charge la vue avec les données
echo $twig->render($view, $data);