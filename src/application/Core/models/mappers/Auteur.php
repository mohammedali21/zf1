<?php 

class  Core_Model_Mapper_Auteur extends Core_Model_Mapper_MapperAbstract{

	
	
	const COL_ID = 'auteur_id';
	const COL_NAME = 'auteur_name';
	const COL_EMAIL = 'auteur_email';
	

	public function rowToObject(Zend_Db_Table_Row $row){
		
		$auteur = new Core_Model_Auteur;
		$auteur->setId($row[self::COL_ID])
		          ->setName($row[self::COL_NAME])
				  ->setEmail($row[self::COL_EMAIL]);
		
		return $auteur;
		
	}

	public function objectToRow(Core_Model_Interface $auteur){
	
		$data = array(
				self::COL_ID => $auteur->getId(),
				self::COL_NAME => $auteur->getNom(),
				self::COL_EMAIL => $auteur->getEmial,
		);
	
		return $data;
	}
	
	public function getAnonymeEntity($name='anonyme'){
		$auteur = new Core_Model_Auteur;
		$auteur->setName($name)
			->setEmail(null);
		
		
		return $auteur;
	}
	
	
}