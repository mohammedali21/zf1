<?php
/**
 * 
 * @author Administrateur
 * @desc Controller par défaut
 *
 */
class Core_ArticleController  extends Zend_Controller_Action
{
	private $blogSvc;
	
	public function init()
	{
		$this->blogSvc = new Core_Service_Blog();
	}
	
	public function indexAction()
	{	
		$this->view->articles = $this->blogSvc->fetchLastArticles(4);		
		
		$newArticle = new Core_Model_Article();
		$categorie = new Core_Model_Categorie();
		$auteur = new Core_Model_Auteur();

		$categorie->setId(1);
		$auteur->setId(1);

		$newArticle->setTitle('test save')
		->setContent('sdfgsdfg')
		->setCategorie($categorie)
		->setAuteur($auteur);

		$this->blogSvc->saveArticle($newArticle);
	}
	
	public function viewAction()
	{
		
		$articleId = (int) $this->getRequest()->getParam('id');
		if (0 === $articleId) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}

		$article = $this->blogSvc->fetchArticleById($articleId);
		if (!$article) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}

		// Cible le conteneur Zend_Navigation principal
		$nav = Zend_Registry::get('Zend_Navigation');
		// Cible le sous conteneur Article (page)
		$articleNav = $nav->findById('coreArticleIndex');
		// Cr��e la nouvelle page correspondant � l'article en cours
		$articlePage = Zend_Navigation_Page::factory(
			array(
				'type' => 'mvc',
				'module' => 'Core',
				'controller' => 'article',
				'action' => 'view',
				'params' => array('id' => $articleId),
				'route' => 'coreArticleView',
				'visible' => false,
				'label' => $article->getTitle()
 			)
		);
		// Injecte la nouvelle page dans le sous conteneur Articles 
		$articleNav->addPage($articlePage);


		$this->view->article = $article;

	}
	
	public function categoriesAction(){
		$this->view->categories = $this->blogSvc->fetchCategories();
	}
	
	
	
	
	
	
}