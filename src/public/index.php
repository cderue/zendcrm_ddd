<?php


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path()
)));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/SymfonyDI'),
    get_include_path()
)));
/*
require_once 'Zend/Loader/ClassMapAutoloader.php';

empty instantiation 
$loader = new Zend\Loader\ClassMapAutoloader(array
  (
    __DIR__ . '/../library/Zend/.classmap.php', 
    __DIR__ . '/../library/Doctrine/.classmap.php',
  )
); 
 
Finally, register with the autoloader 
$loader->register();
*/

require_once 'Zend/Loader/StandardAutoloader.php'; 
  
$loader = new \Zend\Loader\StandardAutoloader(); 
 
// the path can be absolute or relative below: 
$loader->registerNamespace('Zend', __DIR__ . '/../library/Zend'); 
$loader->registerNamespace('MongoEntity', __DIR__ . '/../library/MongoEntity'); 
$loader->registerNamespace('Application\Data\Repository', __DIR__ . '/../application/data/repositories');
$loader->registerNamespace('Application\Domain\Repository', __DIR__ . '/../application/domain');
$loader->registerNamespace('Application\Domain\Object', __DIR__ . '/../application/domain/objects');
$loader->registerNamespace('Application\Domain\Service', __DIR__ . '/../application/domain/services');
/** TO START AUTOLOADING */ 
$loader->register(); 

/** Zend_Application */
require_once 'Zend/Application/Application.php';

// Create application, bootstrap, and run
$application = new Zend\Application\Application (
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$front = \Zend\Controller\Front::getInstance();
$front->setControllerDirectory('../application/controllers');

$application->bootstrap()
            ->run();