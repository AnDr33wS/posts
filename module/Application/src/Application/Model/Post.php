<?php

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Core\Model\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Post
 *
 * @category Application
 * @package Model
 *          @ORM\Entity
 *          @ORM\Table(name="posts")
 */
class Post extends Entity {
	
	/**
	 * @ORM\id
	 * @ORM\column(type="integer")
	 */
	protected $id;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $title;
	
	/**
	 * @ORM\column(type="string")
	 */
	protected $description;
	
	/**
	 * @ORM\column(type="string", name="postdate")
	 */
	protected $postDate;
	
	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
	 */
	protected $comments;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function getPostDate() {
		return $this->postDate;
	}
	public function setPostDate($postDate) {
		$this->postDate = $postDate;
	}
	public function getComments() {
		return $this->comments;
	}
	public function setComments($comments) {
		$this->comments = $comments;
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
					'name' => 'title',
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
					'name' => 'postDate',
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