<?php
/**
 * @namespace
 */
namespace Application\Plugin;

/**
 * Caching plugin
 * 
 * @uses Zend_Controller_Plugin_Abstract
 */
class Cache extends \Zend\Controller\Plugin\AbstractPlugin
{
    /**
     *  @var bool Désactiver le cache ou non
     */
    public static $enabled = true;
    /**
     * @var Zend_Cache_Frontend
     */
    private $_cache;

    /**
     * @var string Clé de cache
     */
    private $_key;

    /**
     * Constructeur: initialise le cache
     * 
     * @param  array|Zend_Config $options 
     * @return void
     * @throws Exception
     */
    public function __construct($options)
    {
        if (!is_array($options) && !($options instanceof \Zend\Config)) {
            throw new  \Zend\Exception('Invalid $options paramater: cache options must be array or \Zend\Config object');
        }
        
        if ($options instanceof \Zend\Config) {
            $options = $options->toArray();
        }

        if (!array_key_exists('frontend', $options)) {
            throw new \Zend\Exception('Invalid cache frontend provided');
        }
        if (!array_key_exists('frontendOptions', $options)) {
            throw new \Zend\Exception('Invalid cache frontend options provided');
        } 
        if (!array_key_exists('backend', $options)) {
            throw new \Zend\Exception('Invalid cache backend provided');
        }
        if (!array_key_exists('backendOptions', $options)) {
            throw new \Zend\Exception('Invalid cache backend options provided');
        } 

        $options['frontendOptions']['automatic_serialization'] = true;

        $this->_cache = \Zend\Cache\Cache::factory(
            $options['frontend'],
            $options['backend'],
            $options['frontendOptions'],
            $options['backendOptions']
        );
    }

    /**
     * Démarre le cache
     *
     * Determine si le cache peut être chargé (cache hit). Si c'est le cas, retourne le contenu du cache
     * 
     * @param  Zend_Controller_Request_Abstract $request 
     * @return void
     */
    public function dispatchLoopStartup(\Zend\Controller\Request\AbstractRequest $request)
    {
        if (!$request->isGet()) {
            self::$enabled = false;
            return;
        }

        $this->_key = md5($request->getPathInfo());
        
        if (false !== ($response = $this->getCache())) {
            $response->sendResponse();
            exit;
        }
    }

    /**
     * Enregistre le cache
     * 
     * @return void
     */
    public function dispatchLoopShutdown()
    {
        if (self::$enabled || !$this->getResponse()->isRedirect() || !is_null($this->_key)) {
            $this->_cache->save($this->getResponse(), $this->_key);
        }
    }
    
    /**
     * 
     */
    public function getCache()
    {
        $response = $this->_cache->load($this->_key);
        if (false !== $response) {
          return $response;
        }
        
        return false;
    }
    
    public function clearCache()
    {
      $this->_cache->clean(\Zend\Cache::CLEANING_MODE_ALL);
    }
}