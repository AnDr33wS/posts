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
use Application\Form\Comment as CommentForm;
use Application\Model\Comment;

class CommentController extends ActionController {
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
	
	public function saveAction() {
		$form = new CommentForm ();
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$comment = new Comment ();
			$form->setInputFilter ( $comment->getInputFilter () );
			$form->setData ( $request->getPost() );
			if ($form->isValid ()) {
				$data = $form->getData ();
				if (isset ( $data ['id'] ) && $data ['id'] > 0) {
					$comment = $this->getEntityManager ()->find ( 'Application\Model\Post', $data ['id'] );
				}
				unset ( $data ['submit'] );
				$comment->setData ( $data );
				$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
				$post = $this->getEntityManager ()->find ( 'Application\Model\Post', $id );
				$comment->setPost($post);
				$this->getEntityManager ()->persist ( $comment );
				$this->getEntityManager ()->flush ();
				return $this->redirect ()->toUrl ( '/application' );
			}
		}
//		 else {
// 			if ($id > 0) { 		
//  				$form->bind ( $comment );
//  				$form->get ( 'submit' )->setAttribute ( 'value', 'Edit' );
//  			}
	
		return new ViewModel ( array (
				'form' => $form
				));
				
}
}
				
				