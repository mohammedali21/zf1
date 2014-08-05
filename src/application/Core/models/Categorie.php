<?php 

class Core_Model_Categorie implements  Core_Model_Interface
{
	/**
	 * @var number
	 */
	private $id;
	/**
	 * @var string
	 */
	private $nom;

	/**
	 * @var array
	 */
	private $articles = array();
	
	/**
	 * @var parent
	 */
	private $parant;

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return the $nom
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param string $nom
	 */
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	/**
	 * @return the $articles
	 */
	public function getArticles() {
		return $this->articles;
	}

	/**
	 * @param multitype: $articles
	 */
	public function setArticles(Array $articles) {
		$this->articles = $articles;
		return $this;
	}

	public function addArticle(Core_Model_Article $article) {
		$this->articles[] = $article;
		return $this;
	}
	/**
	 * @return the $parant
	 */
	public function getParant() {
		return $this->parant;
	}

	/**
	 * @param parent $parant
	 */
	public function setParant(Core_Model_Categorie $parant = null) {
		$this->parant = $parant;
		return $this;
	}



	



}