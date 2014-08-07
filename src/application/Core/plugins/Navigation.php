<?php 



class Core_Plugin_Navigation extends  Zend_Controller_Plugin_Abstract{
	
	
	
	public function routeShutdown(Zend_Controller_Request_Abstract  $request){
		
		
		$blogSrv = new Core_Service_Blog();
		$categories = $blogSrv->fetchCategories();
		
		// Cible le conteneur Zend_Navigation principal
		$nav = Zend_Registry::get('Zend_Navigation');
		
		// Cible le sous conteneur Article (page)
		$articleNav = $nav->findById('coreArticleCategories');
		
		foreach ($categories as $categorie){
			
			// Créée la nouvelle page correspondant à chaque catégorie
			$categoriePage = Zend_Navigation_Page::factory(
					array(
							'type' => 'mvc',
							'module' => 'Core',
							'controller' => 'article',
							'action' => 'categorieview',
							'params' => array('id' => $categorie->getId()),
							'route' => 'coreArticleCategorieView',
							'visible' => true,
							'label' => $categorie->getNom()
					)
			);
			// Injecte la nouvelle page dans le sous conteneur Articles
			$articleNav->addPage($categoriePage);
								
			
			
		}
		
	}
	
	
}