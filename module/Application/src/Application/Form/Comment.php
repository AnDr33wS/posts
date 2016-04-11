<?php

namespace Application\Form;

use Zend\Form\Form;

class Comment extends Form {
	public function __construct() {
		parent::__construct ( 'comment' );
		$this->setAttribute ( 'method', 'post' );
		$this->setAttribute ( 'action', '/application/comment/save' );
		
		$this->add ( array (
				'name' => 'id',
				'attributes' => array (
						'type' => 'hidden' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'description',
				'attributes' => array (
						'type' => 'textarea' 
				),
				'options' => array (
						'label' => 'Descrição' 
				) 
		) );
		$this->add ( array (
				'name' => 'name',
				'attributes' => array (
						'type' => 'text' 
				),
				'options' => array (
						'label' => 'Nome' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'email',
				'attributes' => array (
						'type' => 'text' 
				),
				'options' => array (
						'label' => 'Email' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'webpage',
				'attributes' => array (
						'type' => 'text' 
				),
				'options' => array (
						'label' => 'Pagina da WEB' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'submit',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Enviar',
						'id' => 'submitbutton' 
				) 
		) );
	}
}


