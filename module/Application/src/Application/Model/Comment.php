<?php

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Core\Model\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Comment
 *
 * @category Application
 * @package Model
 *          @ORM\Entity
 *          @ORM\Table(name="comments")
 */
class Comment extends Entity {
	
	/**
	 * @ORM\id
	 * @ORM\column(type="integer")
	 */
	protected $id;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $description;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $name;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $email;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $webpage;
	
	/**
	 * @ORM\column(type="string", name="comment_date")
	 */
	protected $commentDate;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
	 * @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
	 */
	protected $post;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getPostId() {
		return $this->post_id;
	}
	public function setPostId($post_id) {
		$this->post_id = $post_id;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getWebpage() {
		return $this->webpage;
	}
	public function setWebpage($webpage) {
		$this->webpage = $webpage;
	}
	public function getCommentDate() {
		return $this->commentDate;
	}
	public function setCommentDate($commentDate) {
		$this->commentDate = $commentDate;
	}
	public function getPost() {
		return $this->post;
	}
	public function setPost($post) {
		$this->post = $post;
	}
	/**
	 * Configura os filtros dos campos da entidade
	 *
	 * @return Zend\InputFilter\InputFilter
	 */
	public function getInputFilter() {
		if (! $this->inputFilter) {
			$inputFilter = new InputFilter ();
			$factory = new InputFactory ();
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'id',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'Int' 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'post_id',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'Int' 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'description',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'email',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'EmailAddress' 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'name',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100 
									) 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'webpage',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 200 
									) 
							) 
					) 
			) ) );
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'comment_date',
					'required' => false,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					) 
			) ) );
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}