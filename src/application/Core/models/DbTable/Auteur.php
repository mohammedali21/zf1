<?php 

class Core_Model_DbTable_Auteur extends Zend_Db_Table_Abstract
{
	protected $_name = 'auteur';

	protected $_primary = 'auteur_id';

	protected $_dependentTables = array(
		'Core_Model_DbTable_Article'
	);
}