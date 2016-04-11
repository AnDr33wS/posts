<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Model\Post;
use Application\Form\Post as PostForm;

class IndexController extends ActionController {
	/**
	 *
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;
	public function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator ()->get ( 'Doctrine\ORM\EntityManager' );
		}
		return $this->em;
	}
	public function indexAction() {
		$posts = $this->getEntityManager ()->getRepository ( 'Application\Model\Post' )->findAll ();
		return new ViewModel ( array (
				'posts' => $posts 
		) );
	}
	public function saveAction() {
		$form = new PostForm ();
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$post = new Post ();
			$form->setInputFilter ( $post->getInputFilter () );
			$form->setData ( $request->getPost () );
			if ($form->isValid ()) {
				$data = $form->getData ();
				if (isset ( $data ['id'] ) && $data ['id'] > 0) {
					$post = $this->getEntityManager ()->find ( 'Application\Model\Post', $data ['id'] );
				}
				unset ( $data ['submit'] );
				// configurar a data do post
				$post->setData ( $data );
				$this->getEntityManager ()->persist ( $post );
				$this->getEntityManager ()->flush ();
				return $this->redirect ()->toUrl ( '/application' );
			}
		} else {
			$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
			if ($id > 0) {
				$post = $this->getEntityManager ()->find ( 'Application\Model\Post', $id );
				$form->bind ( $post );
				$form->get ( 'submit' )->setAttribute ( 'value', 'Edit' );
			}
		}
		return new ViewModel ( array (
				'form' => $form 
		) );
	}
	public function deleteAction() {
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		if ($id == 0) {
			throw new \exception ( "Código obrigatório" ); 
		}
		$post = $this->getEntityManager ()->find ( 'Application\Model\Post', $id );
		if ($post) {
			$this->getEntityManager ()->remove ( $post );
			$this->getEntityManager ()->flush ();
		}
		return $this->redirect ()->toUrl ( '/application' );
	
	
	}
}
