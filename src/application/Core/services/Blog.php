<?php 

class Core_Service_Blog
{
	
	
	public function fetchCategories($asArray = false){
		
		$mapper = new Core_Model_Mapper_Categorie();
		$result = $mapper->fetchAll();
		if(false === $asArray){
			return $result;
		}else {
			$resulArray = array();
			foreach($result as $categorie){
				$resulArray[$categorie->getId()] = $categorie->getNom();
			}
			
			return $resulArray;
		}
	}
	
	public function fetchAuteurs($asArray = false){
	
		$mapper = new Core_Model_Mapper_Auteur();
		$result = $mapper->fetchAll();
		if(false === $asArray){
			return $result;
		}else {
			$resulArray = array();
			foreach($result as $auteur){
				$resulArray[$auteur->getId()] = $auteur->getName();
			}
				
			return $resulArray;
		}
	}
	
	
	public function finCategories($id){
	
		
		if (0 === (int) $id) {
			throw new InvalidArgumentException('articleId doit �tre un entier sup�rieur � 1');
		}
		$mapper = new Core_Model_Mapper_Categorie();
		return $mapper->find($id);
	}
	
	
	
	/**
	 * Fetches last articles (ordered by date)
	 * @param number $count number of fetched articles
	 */
	public function fetchLastArticles($count = 5)
	{
		$count = (int) $count;

		if (0 === $count) {
			throw new InvalidArgumentException('count doit �tre un entier sup�rieur � 1');
		}

		$mapper = new Core_Model_Mapper_Article;
		$articles = $mapper->fetchAll(null,'article_id DESC', $count);

		return $articles;

	}

	/**
	 * @param number $articleId
	 * @throws InvalidArgumentException
	 * @return Core_Model_Article
	 */
	public function fetchArticleById($articleId)
	{
		if (0 === (int) $articleId) {
			throw new InvalidArgumentException('articleId doit �tre un entier sup�rieur � 1');
		}

		$mapper = new Core_Model_Mapper_Article;
		$article = $mapper->find($articleId);

		return $article;

	}
	public function  saveArticle(Core_Model_Article $article){
		$mapper = new Core_Model_Mapper_Article;
		$mapper->save($article); 
		//qiojgqllqghsjlkhj 
	}
	
	public function fetchArticlesByIdCategorie($id){
		
		$count = (int) $count;
		
		if (0 === $count) {
			throw new InvalidArgumentException('count doit �tre un entier sup�rieur � 1');
		}
		
		$mapper = new Core_Model_Mapper_Article;
		$where = array(Core_Model_Mapper_Article::COL_CATEGORIE_ID . ' = ?' => $id);
		$articles = $mapper->fetchAll($where,'article_id DESC');
		
		return $articles;
		
		
	}
	
	
	
	public function ajouterArticle(){
		
		$mapper = new Core_Model_Mapper_Article;
		
		
	}
}