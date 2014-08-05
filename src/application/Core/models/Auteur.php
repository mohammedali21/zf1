<?php
class Core_Model_Auteur{

	private $name;
	private $id;
	private $email;
	
	private $articles = array();
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $articles
	 */
	public function getArticles() {
		return $this->articles;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
		

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * @param multitype: $articles
	 */
	public function setArticles($articles) {
		$this->articles = $articles;
		return $this;
	}
	
	public  function addArticle(Core_Model_Article $article){
		$this->articles[] = $article;
		return $this;
	}
	
	

	
	
}