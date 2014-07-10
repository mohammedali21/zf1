<?php 

class  Core_Model_Mapper_Auteur{

	private $dbTable;
	
	public function __construct(){
		$this->dbTable = new Core_Model_DbTable_Categorie();
		}
	public function rowToObject(Zend_Db_Table_Row $row){
		
		$auteur = new Core_Model_Categorie;
		$auteur->setId($row['auteur_id'])
		          ->setNom($row['auteur_name']);
		
		return $auteur;
		
	}	
}