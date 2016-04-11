<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array (
		'service_manager' => array (
				'factories' => array (
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory' 
				) 
		),
		
		'doctrine' => array (
				'connection' => array (
						'driver' => 'pdo_mysql',
						'charset' => 'UTF8',
						'host' => 'localhost',
						'port' => '3306',
						'user' => 'root',
						'dbname' => 'posts',
						'password' => '!9293709B13BruH17'
				)
			),

// 		'doctrine' => array(
// 				'connection' => array(
// 						'orm_default' => array(
// 								'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
// 								'params' => array(
// 										'host'     => 'localhost',
// 										'port'     => '3306',
// 										'user'     => 'root',
// 										'password' => '!9293709B13BruH17',
// 										'dbname'   => 'posts',
// 								)
// 						)
// 				)
// 		),
		
		
		
		'acl' => array (
				'roles' => array (
						'visitante' => null,
						'redator' => 'visitante',
						'admin' => 'redator' 
				),
				'resources' => array (
						'Application\Controller\Index.index',
						'Application\Controller\Index.save',
						'Admin\Controller\Index.save',
						'Admin\Controller\Index.delete',
						'Admin\Controller\Auth.index',
						'Admin\Controller\Auth.login',
						'Admin\Controller\Auth.logout',
						'Application\Controller\Comment.save'
						
				),
				'privilege' => array (
						'visitante' => array (
								'allow' => array (
										'Application\Controller\Index.index',
										'Application\Controller\Index.save',
										'Admin\Controller\Auth.index',
										'Admin\Controller\Auth.login',
										'Admin\Controller\Auth.logout',
										'Application\Controller\Comment.save'
								) 
						),
						'redator' => array (
								'allow' => array (
										'Admin\Controller\Index.save' 
								) 
						),
						'admin' => array (
								'allow' => array (
										'Admin\Controller\Index.delete' 
								) 
						) 
				) 
		) 
)
;

