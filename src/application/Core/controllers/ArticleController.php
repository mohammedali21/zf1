<?php
/**
 * 
 * @author Administrateur
 * @desc Controller par dÃ©faut
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
		// Créée la nouvelle page correspondant à l'article en cours
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
	
	public function categorieviewAction(){
		
		
		$categorieId = $this->getRequest()->getParam('id');
		$this->view->articles = $this->blogSvc->fetchArticlesByIdCategorie($categorieId);
		
		$this->view->categorie =$this->blogSvc->finCategories($categorieId);
		
		
		
	}
	
	
	public function addarticleAction(){	
		
		
		$form = new Core_Form_AddArticle();
		$form->setAction('')
			 ->setMethod(Zend_form::METHOD_POST);
		//si HTTP post, reception de formulaire	
		if($this->getRequest()->isPost()){
			//Si tou
			//renvoient TRUE
			if($form->isValid($this->getRequest()->getPost())){				
				$mapper = new Core_Model_Mapper_Article();
				$article = $mapper->arrayToObject($form->getValues());
				try{
				$this->blogSvc->saveArticle($article);
				$this->view->message = "Article ajouter";					
				}catch (Exception $e){
					$this->view->message = $e->getMessage();
				}
			}
			
			
				
		}
		
		$this->view->form = $form;
		
		
	}
	
	public function archiverAction(){
	
		$auth = Zend_Auth::getInstance();
		$userAuth = $auth->getIdentity();
	
		$acl = Zend_Registry::get('Zend_Acl');
	
		$articleId = (int) $this->getRequest()->getParam('id');
		$article = $this->blogSvc->fetchArticleById($articleId);
	
		if ($acl->isAllowed($userAuth, $article, 'archiver')) {
			var_dump('OK pour larchive');
		} else {
			var_dump('NON');
		}
	
		exit;
	}
	
	
	
	
	
	
}