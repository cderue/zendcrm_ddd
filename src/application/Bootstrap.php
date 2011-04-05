<?php
/** 
 * Copyright (c) 2011, Cédric DERUE
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the University of California, Berkeley nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Initialisation des ressources de l'application
 */
class Bootstrap extends \Zend\Application\Bootstrap
{
  /**
   * Initialiser la session
   */  
  protected function _initSession()
  {		
    $config = new \Zend\Session\Configuration\SessionConfiguration();
    //$config->setStorageOption('cookie_secure', true);
    $config->setStorageOption('name', 'zendcrm');
    $config->setStorageOption('save_path', 'C:\sessions\zendcrm');
    $config->setStorageOption('cookie_httponly', true);
    $config->setStorageOption('gc_maxlifetime', 10 * 60);
    $storage = new \Zend\Session\Storage\SessionStorage();
    $chain = new \Zend\Session\ValidatorChain($storage);
    $validator = new \Zend\Session\Validator\HttpUserAgent();
    $chain->connect('session.validate', $validator);
    $manager = new \Zend\Session\SessionManager($config, $storage);
    $manager->start();
  }  
  
  /**
   * Initialiser la base de données MongoDB
   */   
  protected function _initDb()
  {
    // Charge le fichier de configuration
    $config = new \Zend\Config\Config($this->getOptions());
    // Recupère les paramètres de connexion à la base de données
    $mongo = $config->mongo->params;
    // Stocke les paramètres de connexion dans le registre
    \Zend\Registry::set('mongo', $mongo);
  }
  
  /**
   * Initialiser les plugins du contrôleur frontal
   */
  protected function _initPlugin()
  {
    // Récupère l'instance du contrôleur frontal  
    $front = \Zend\Controller\Front::getInstance();
    // Enregistre le plugin d'authentification auprès du contrôleur frontal
    //$front->registerPlugin(new \Application\Plugin\Authentication(), 1);
    //
		$broker = $front->getHelperBroker();
    $broker->register('LeadHelper', new \Application\Plugin\LeadHelper());
    $broker->register('ContactHelper', new \Application\Plugin\ContactHelper());
    $broker->register('AccountHelper', new \Application\Plugin\AccountHelper());
   
    // Configure et enregistre le plugin de cache
    /*$config = new \Zend\Config\Config($this->getOptions());
    $options = array();
    $options['frontend'] = $config->cache->frontEnd;
    $options['frontendOptions']['lifetime'] = $config->cache->frontEndOptions->lifetime;
    $options['backend'] = $config->cache->backEnd;
    $options['backendOptions']['lifetime'] = $config->cache->backEndOptions->lifetime;
    $front->registerPlugin(new \Zendcrm\Controller\Plugin\Cache($options), 10);*/
  }
  
  /**
   * Initialiser le routage des requêtes REST
   */
  protected function _initRestRoute()
  {
    $this->bootstrap('frontController');
    $frontController = \Zend\Controller\Front::getInstance();
    //$restRoute = new \Zend\Rest\Route($frontController);
		// Specifying the "api" module as RESTful, and the "task" controller of the
		// "backlog" module as RESTful:
		$restRoute = new \Zend\Rest\Route($frontController, array(), array('application' => array('lead-rest')));
//$router->addRoute('rest', $restRoute);
    $frontController->getRouter()->addRoute('rest', $restRoute);
  }
}