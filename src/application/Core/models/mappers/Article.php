<?php 

class Core_Model_Mapper_Article extends  Core_Model_Mapper_MapperAbstract
{

	
		
	const COL_ID = 'article_id';
	const COL_TITLE = 'article_title';
	const COL_CONTENT = 'article_content';
	const COL_CATEGORIE_ID = 'categorie_id';
	const COL_AUTEUR_ID = 'auteur_id';

	
	//protected  $dbTableClassname = 'Core_Model_DbTable_Article';
	


// 	public function fetchAll($where=null, $order=null, $count=null, $offset=null) 
// 	{
// 		$rowset = $this->dbTable->fetchAll($where,$order, $count, $offset);
// 		$articles = array(); 
// 		foreach ($rowset as $row) {
// 			$articles[] = $this->rowToObject($row);
// 		}
// 		return $articles;
// 	}
	
	public function delete($id){
		$row = $this->dbTable->find($id)->count();
		if(!$row instanceof  Zend_Db_Table_Row_Abstract){
			throw new Zend_Db_Table_Row_Exception('inpossible de supprimer l\'élément' . $id);
		}
		return (bool) $row->delete();
	}	


	public function rowToObject(Zend_Db_Table_Row $row)
	{
		$article = new Core_Model_Article;
		$article->setId($row[self::COL_ID])
				->setTitle($row[self::COL_TITLE])
				->setContent($row[self::COL_CONTENT]);

		$rowCategorie = $row->findParentRow('Core_Model_DbTable_Categorie');
		$rowAuteur = $row->findParentRow('Core_Model_DbTable_Auteur');
		
		$mapperAuteur = new Core_Model_Mapper_Auteur();
		if($rowAuteur){			
			$auteur = $mapperAuteur->rowToObject($rowAuteur);
		}else{
			$auteur = $mapperAuteur->getAnonymeEntity('inconnu');
		}
		
		$mapperCategorie = new Core_Model_Mapper_Categorie();
		$categorie = $mapperCategorie->rowToObject($rowCategorie);
		
	

		$categorie->addArticle($article);
		$auteur->addArticle($article);
		$article->setCategorie($categorie);
		$article->setAuteur($auteur);
		
		return $article;
	}
	public function objectToRow(Core_Model_Interface $article){
		
		$data = array(
			self::COL_ID => $article->getId(),
			self::COL_TITLE => $article->getTitle(),
			self::COL_CONTENT => $article->getContent(),
			self::COL_CATEGORIE_ID => $article->getCategorie()->getId(),
			//self::COL_AUTEUR_ID => $article->getAuteur()->getId()
		);
		
		if( $article->getCategorie() !== null){
			$data[self::COL_AUTEUR_ID] = $article->getAuteur()->getId();
		}else{
			$data[self::COL_AUTEUR_ID] = Zend_Db::NULL_TO_STRING;
		}
		
		return $data;
	}
}