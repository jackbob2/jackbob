<?php

//require_once APP_PATH . "vendor/autoload.php" ;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Description of Doctrine
 *
 * @author Jacky Amirel
 */
class Doctrine {
    
    /**
     * The entityManager handle doctrine
     */
    private static $entityManager ;
    
    /**
     * Class constructor
     */
    private function __construct(){}    
    
    /**
     * Initialize all object and datas that Doctrine's need
     */
    public static function initialize(){
        $paths = array(APP_PATH . "application/models");
        $isDevMode = true;
        
        $iniFile = APP_PATH . 'application/settings.ini' ;
        if(!is_file($iniFile)) exit("Fichier de configuration non trouvé !") ;

        $dataInifile = parse_ini_file($iniFile) ;

        if(!is_array($dataInifile) || empty($dataInifile['user'])) exit("Erreur du fichier de configuration") ;

        // the connection configuration
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => $dataInifile['user'],
            'password' => $dataInifile['pass'],
            'dbname'   => $dataInifile['base'],
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        self::$entityManager = EntityManager::create($dbParams, $config);

        $classLoader = new \Doctrine\Common\ClassLoader('Entity', 'application/models/');
        $classLoader->register();
        
    }
    
    /**
     * Return entityManager
     * @return type
     */
    public static function getEntityManager(){
        return self::$entityManager ;
    }
}
