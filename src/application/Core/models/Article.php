<?php 

class Core_Model_Article implements Core_Model_Interface{
	
	
	/**
	 * 
	 * @var number
	 */
	private $id;
	/**
	 * 
	 * @var string
	 */
	private $title;
	/**
	 * 
	 * @var string $content
	 */
	private $content;
	
	private $categorie;
	
	private $auteur = null;
	
	/**
	 * @return the $id
	 */	
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	/**
	 * @return the $categorie
	 */
	public function getCategorie() {
		return $this->categorie;
	}

	/**
	 * @param field_type $categorie
	 */
	public function setCategorie(Core_Model_Categorie $categorie) {
		$this->categorie = $categorie;
		return $this;
	}
	/**
	 * @return the $auteur
	 */
	public function getAuteur() {
		return $this->auteur;
	}

	/**
	 * @param field_type $auteur
	 */
	public function setAuteur(Core_Model_Auteur $auteur) {
		$this->auteur = $auteur;
		return $this;
	}

	
	

	

	
	
	
}

