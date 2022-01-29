<?php
// déclaration d'une classe Auteur
class Ecusson
{
	// attributs en relation avec la base de données
	public $id;
	public $ecusson;

	// une méthode qui permet de modifier les attributs de l'objet sur lequel elle est appliquée
	function modifier($ecusson) {
		$this->ecusson = $ecusson;
	}

	// une méthode pour afficher les attributs de l'objet
	function afficher()
	{
		echo '<p>' . $this->ecusson . ' (id = ' . $this->id . ')</p>';
	}

	function chargePOST() {
		// si une valeur a été reçue dans $_POST['ecusson'] il faut la copier dans l'attribut ecusson et la filter
		if (isset($_POST['ecusson'])) {
			$this->ecusson = $_POST['ecusson'];
			$this->ecusson = strip_tags($this->ecusson);
			$this->ecusson = htmlspecialchars($this->ecusson, ENT_QUOTES, 'UTF-8');
		}
		// si une valeur a été reçue dans $_POST['id'] il faut la copier dans l'attribut id et la convertir en entier
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->id = intval($_POST['id']);
		}
	}
	// une méthode pour récupérer une table dans un tableau d'objets depuis une base de données
	static function readAll() {
		// définition de la requête SQL
		$sql= 'select * from stoklosa_info3_blog.equipe';

		// préparation de la requête
		$pdo = connexion('equipe');
		$query = $pdo->prepare($sql);

		// exécution de la requête
		$query->execute();

		// récupération de toutes les lignes sous forme d'objets
		$tableau = $query->fetchAll(PDO::FETCH_CLASS,'Ecusson');

		// retourne le tableau d'objets
		return $tableau;
	}
}