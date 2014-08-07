<?php 

class Core_Bootstrap extends Zend_Application_Module_Bootstrap
{

	
	protected  function _initAutooaldind(){
		
		$loader = new Zend_Application_Module_Autoloader(
			
				array(

					'namespace' => 'Core',
					'basePath' => APP_PATH . '/Core'
			 
				));
		$loader->addResourceType('assert', 'asserts', 'Assert');
	
	

	}
	
	
	protected function _initAcl()
	{
		$acl = new Zend_Acl();

		//Lorsque vous spécifiez plusieurs parents pour un rôle, 
		//conservez à l'esprit que le dernier parent listé est le premier 
		//dans lequel une règle utilisable sera recherchée.

//RO		//Invite 
//RO		//Staff -> Invite
//RO		//Editeur -> Staff
//RO		//Admin

//RE		//Article
//RE		//Author

//PR		//Connexion -> ?
//PR		//Voir	-> Invite

//PR		//Modifier -> Staff
//PR		//Soumettre -> Staff
//PR		//Relire -> Staff

//PR		//Publier -> Editeur
//PR		//Archiver -> Editeur
//PR		//Supprimer -> Editeur


		//$acl->allow('Admin', null, null);


		$acl->addRole('invite')
			->addRole('staff','invite')
			->addRole('editeur','staff')
			->addRole('admin');



		$acl->addResource('article')
			->addResource('categorie')
			->addResource('categorie8ans', 'categorie')
			->addResource('categorie18ans', 'categorie')
			->addResource('auteur');
			

		$acl->allow(null, null, 'connexion');
		
		$acl->allow(null, null, 'deconnexion');


		$acl->allow('staff', 'auteur', 'modifier');
		$acl->allow('staff', 'article', 'soumettre');
		$acl->allow('staff', 'article', 'relire');
		
		$acl->allow('staff', 'article', 'publier');
		$acl->allow('staff', 'article', 'archiver');
		//correction
		
		$acl->allow('invite', null, 'connexion');
		$acl->allow('admin');
				
				
		$acl->deny(array('staff', 'editeur', 'admin'), null, 'connexion');
		$acl->allow(array('staff', 'editeur', 'admin'), null, 'deconnexion');
		
		$acl->allow('staff', 'article', array('modifier', 'soumettre', 'relire'));
		$acl->allow('editeur', 'article', array('publier', 'archiver', 'supprimer'));
		
		$acl->addResource('Core::index::index');
		$acl->allow('admin','Core::index::index', 'access');
		
		$acl->addResource('Core::index::logout');
		$acl->allow('admin','Core::index::logout', 'access');
		
		$acl->addResource('Core::article::index');
		$acl->allow('admin','Core::article::index', 'access');
		
		$acl->addResource('Core::article::view');
		$acl->allow('admin','Core::article::view', 'access');
		
		$acl->addResource('Core::article::categories');
		$acl->allow('admin','Core::article::categories', 'access');
		
		$acl->addResource('Core::article::addarticle');
		$acl->allow('admin','Core::article::addarticle', 'access');
		
		$acl->addResource('Core::article::categorieview');
		$acl->allow('admin','Core::article::categorieview', 'access');
		
		$acl->addResource('Core::index::signin');
		$acl->allow('invite','Core::index::signin', 'access');

		$acl->allow(null, null, 'access');
		
		/*
		$acl->addRole('parents')
			->addRole('facteur')
			->addRole(new Zend_Acl_Role('papa'), array('facteur', 'parents'))
			->addRole(new Zend_Acl_Role('maman'), 'parents')
			->addRole('nourrice', 'maman')
			->addRole('enfants')
			->addRole('adopter')
			->addRole('bebe', 'enfants')
			->addRole('mario', 'enfants')
			->addRole('luigi', 'enfants')
			->addRole('peach', array('bebe','enfants', 'adopter'));
		
		$acl->addResource(new Zend_Acl_Resource('television'))
			->addResource('lave-linge')
			->addResource('lave-vaiselle')
			->addResource('seche-linge')
			->addResource('voiture')
			->addResource('maman')
			->addResource('papa')
			->addResource('peach')
			->addResource('bebe')
			->addResource('parents')
			->addResource('enfants');
		
		//allow($roles = null, $resources = null, $privileges = null, $assert = null)
		$acl->allow(null, 'television', 'canal+');
		$acl->deny('enfants', 'television', 'xxl');
		$acl->allow(null, 'television', null);
		
		$acl->allow('maman', 'bebe', 'lait');
		$acl->deny('nourrice', 'bebe', 'lait');
		
		$acl->allow('nourrice', 'bebe', 'bouteille_lait');
		*/


		Zend_Registry::set('Zend_Acl', $acl);
	}

	protected function _initPlugins()
	{
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Core_Plugin_Navigation);
		$fc->registerPlugin(new Core_Plugin_Auth);
		$fc->registerPlugin(new Core_Plugin_AccessHandler(), 80);
	}
}