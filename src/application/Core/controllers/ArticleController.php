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
		$this->view->articles = $this->blogSvc->fetchLastArticles(2);		
		
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
		$articleId = (int) $this->getRequest()->getParam('id', 404);
		if(0 === $articleId){
			throw new Zend_Controller_Action_Exception('article inconnue');
		}
		$this->view->article = $this->blogSvc->fetchArticleById($articleId);
	}
}