<?php
// déclaration d'une classe Auteur
class Article
{
	// attributs en relation avec la base de données
	public $id;
	public $titre;
	public $categorie;
	public $date;
	public $img_article;
	public $texte_intro;
	public $contenu;

	// une méthode qui permet de modifier les attributs de l'objet sur lequel elle est appliquée
	function modifier($titre, $categorie, $date, $img_article, $texte_intro, $contenu) {
		$this->titre = $titre;
		$this->categorie = $categorie;
		$this->date = $date;
		$this->img_article = $img_article;
		$this->texte_intro = $texte_intro;
		$this->contenu = $contenu;		
	}

	// une méthode pour afficher les attributs de l'objet
	function afficher()
	{
		echo '<p>' . $this->titre . ' ' . $this->categorie . ' ' .$this->date. ' ' .$this->img_article.' ' .$this->texte_intro. ' ' . $this->contenu .' (id = ' . $this->id . ')</p>';
	}

	function chargePOST() {
		// si une valeur a été reçue dans $_POST['categorie'] il faut la copier dans l'attribut categorie et la filter
		if (isset($_POST['categorie'])) {
			$this->categorie = $_POST['categorie'];
			$this->categorie = strip_tags($this->categorie);
			$this->categorie = htmlspecialchars($this->categorie, ENT_QUOTES, 'UTF-8');
		}
		if (isset($_POST['date'])) {
			$this->date = $_POST['date'];
			$this->date = strip_tags($this->date);
			$this->date = htmlspecialchars($this->date, ENT_QUOTES, 'UTF-8');
		}
		// si une valeur a été reçue dans $_POST['titre'] il faut la copier dans l'attribut titre et la filter
		if (isset($_POST['titre'])) {
			$this->titre = $_POST['titre'];
			$this->titre = strip_tags($this->titre);
			$this->titre = htmlspecialchars($this->titre, ENT_QUOTES, 'UTF-8');
		}
		if (isset($_POST['img_article'])) {
			$this->img_article = $_POST['img_article'];
			$this->img_article = strip_tags($this->img_article);
			$this->img_article = htmlspecialchars($this->img_article, ENT_QUOTES, 'UTF-8');
		}
		if (isset($_POST['texte_intro'])) {
			$this->texte_intro = $_POST['texte_intro'];
			$this->texte_intro = strip_tags($this->texte_intro);
			$this->texte_intro = htmlspecialchars($this->texte_intro, ENT_QUOTES, 'UTF-8');
		}
		if (isset($_POST['contenu'])) {
			$this->contenu = $_POST['contenu'];
			$this->contenu = strip_tags($this->contenu);
			$this->contenu = htmlspecialchars($this->contenu, ENT_QUOTES, 'UTF-8');
		}
		// si une valeur a été reçue dans $_POST['id'] il faut la copier dans l'attribut id et la convertir en entier
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->id = intval($_POST['id']);
		}
	}

	// une méthode pour récupérer un objet depuis une base de données, grâce à son id
	static function readOne($id) {
		// définition de la requête SQL avec un paramètre :valeur
		$sql= 'select * from stoklosa_info3_blog.article where id = :valeur';

		// préparation de la requête
		$pdo = connexion('article');
		$query = $pdo->prepare($sql);

		// on lie le paramètre :valeur à la variable $id reçue
		$query->bindValue(':valeur', $id, PDO::PARAM_INT);

		// exécution de la requête
		$query->execute();

		// récupération de l'unique ligne
		$objet = $query->fetchObject('Article');

		// retourne l'objet contenant le résultat
		return $objet;
	}

	// une méthode pour récupérer une table dans un tableau d'objets depuis une base de données
	static function readAll() {
		// définition de la requête SQL
		$sql= 'select * from stoklosa_info3_blog.article';

		// préparation de la requête
		$pdo = connexion('article');
		$query = $pdo->prepare($sql);

		// exécution de la requête
		$query->execute();

		// récupération de toutes les lignes sous forme d'objets
		$tableau = $query->fetchAll(PDO::FETCH_CLASS,'Article');

		// retourne le tableau d'objets
		return $tableau;
	}

	// une méthode pour inséré une ligne dans une base de données à partir des attributs de l'objet courant
	function create() {
		// construction de la requête :categorie, :titre sont les valeurs à insérées
		$sql = 'INSERT INTO stoklosa_info3_blog.article (categorie, date, titre, img_article, texte_intro, contenu) VALUES (:categorie, :date, :titre, :img_article, :texte_intro, :contenu);';
		// préparation de la requête
		$pdo = connexion('article');
		$query = $pdo->prepare($sql);

		// on donne une valeur aux paramètres à partir des attributs de l'objet courant
		$query->bindValue(':categorie', $this->categorie, PDO::PARAM_STR);
		$query->bindValue(':date', $this->date, PDO::PARAM_STR);
		$query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
		$query->bindValue(':img_article', $this->img_article, PDO::PARAM_STR);
		$query->bindValue(':texte_intro', $this->texte_intro, PDO::PARAM_STR);
		$query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
		

		// exécution de la requête
		$query->execute();

		// on récupère la clé de l'auteur inséré
		$this->id = $pdo->lastInsertId();
	}

	// une méthode pour mettre à jour une ligne dans une base de données à partir des attributs de l'objet courant
	function update() {
		// construction de la requête :categorie, :titre sont les valeurs à insérées
		$sql = 'UPDATE stoklosa_info3_blog.article SET categorie = :categorie, date = :date, titre = :titre, img_article = :img_article, texte_intro = :texte_intro, contenu = :contenu WHERE id = :id;';

		// préparation de la requête
		$pdo = connexion('article');
		$query = $pdo->prepare($sql);

		// on donne une valeur aux paramètres à partir des attributs de l'objet courant
		$query->bindValue(':id', $this->id, PDO::PARAM_INT);
		$query->bindValue(':categorie', $this->categorie, PDO::PARAM_STR);
		$query->bindValue(':date', $this->date, PDO::PARAM_STR);
		$query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
		$query->bindValue(':img_article', $this->img_article, PDO::PARAM_STR);
		$query->bindValue(':texte_intro', $this->texte_intro, PDO::PARAM_STR);
		$query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
		

		// exécution de la requête
		$query->execute();
	}


	// une méthode pour supprimer la ligne dont la clé est fournie en paramètre
	static function delete($id) {
		$sql = 'DELETE FROM stoklosa_info3_blog.article WHERE id = :id;';

		// préparation de la requête
		$pdo = connexion('article');
		$query = $pdo->prepare($sql);

		// on lie le paramètre :id à la variable $id reçue
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		// exécution de la requête
		$query->execute();
	}
}