<?php 

class Core_Model_Mapper_Article 
{
	private $dbTable;

	public function __construct()
	{
		$this->dbTable = new Core_Model_DbTable_Article();
	}

	public function find($id) 
	{
		$rowArticle = $this->dbTable->find($id)->current();
		$article = $this->rowToObject($rowArticle);
		return $article;
	}

	public function fetchAll($where=null, $order=null, $count=null, $offset=null) 
	{
		$rowset = $this->dbTable->fetchAll($where,$order, $count, $offset);
		$articles = array(); 
		foreach ($rowset as $row) {
			$articles[] = $this->rowToObject($row);
		}
		return $articles;
	}
	
	public function delete($id){
		$row = $this->dbTable->find($id)->count();
		if(!$row instanceof  Zend_Db_Table_Row_Abstract){
			throw new Zend_Db_Table_Row_Exception('inpossible de supprimer l\'�l�ment' . $id);
		}
		return (bool) $row->delete();
	}
	
	public function save(Core_Model_Article $article){
		
			$origin = $this->dbTable->find($article->getId())->current();
		$row = $this->objectToRow($article);
		if ($origin instanceof Zend_Db_Table_Row_Abstract) {
			// Update
			$where = array('article_id = ?' => $article->getId());
			$this->dbTable->update($row, $where);
		} else {
			// Insert
			unset($row['article_id']);
			$this->dbTable->insert($row);
		}
	}

	public function rowToObject(Zend_Db_Table_Row $row)
	{
		$article = new Core_Model_Article;
		$article->setId($row['article_id'])
				->setTitle($row['article_title'])
				->setContent($row['article_content']);

		$rowCategorie = $row->findParentRow('Core_Model_DbTable_Categorie');
		$rowAuteur = $row->findParentRow('Core_Model_DbTable_Auteur');
		
		$mapperCategorie = new Core_Model_Mapper_Categorie();
		$categorie = $mapperCategorie->rowToObject($rowCategorie);
		
		$mapperAuteur = new Core_Model_Mapper_Auteur();
		$auteur = $mapperAuteur->rowToObject($rowAuteur);

		$categorie->addArticle($article);
		$article->setCategorie($categorie);
		$article->setAuteur($auteur);
		return $article;
	}
	public function objectToRow(Core_Model_Article $article){
		
		return array(
			'article_id' => $article->getId(),
			'article_title' => $article->getTitle(),
			'article_content' => $article->getContent(),
			'categorie_id' => $article->getCategorie()->getId(),
			'auteur_id'	=> $article->getAuteur()->getId()
		);
	}
}