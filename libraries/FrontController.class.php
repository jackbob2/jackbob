<?php

/**
 * Description of FrontController
 *
 * @author Jacky Amirel
 */
class FrontController {
    
    /**
     * Array to store the requests
     * @access protected
     * 
     * @var $aRequests 
     */
    protected $aRequests = array();
    
    
    public function __construct(array $aRequests) {
        $this->aRequests = $aRequests;
    }
    
    /**
     * Get the request with URL
     * @return array $request
     */
    public function getRequest(){
        
        // extract url to get all params
        $this ->extractURL();
        
        if(empty($this->aRequests['action'])) $this->aRequests['action'] = 'index' ;

        //require the controller classes
        $controllerFile = 'IndexController' ;
        if(!empty($this->aRequests['controller'])){
            $controllerFile = ucfirst(strtolower($this->aRequests['controller'])) . 'Controller' ;
        }
        
        // require the file controller
        if(is_file(APP_PATH . 'application/controllers/'.$controllerFile.'.php')){
            require(APP_PATH . "application/controllers/".$controllerFile.".php");
        }
        
        return $this->aRequests ;
        
    }
    
    /**
     * Extract the URL and get params(controller, action, ..)
     */
    public function extractURL(){
        if(!empty($this->aRequests) && !empty($this->aRequests['url']) && preg_match("/\//", $this->aRequests['url'])){
            $tmp = explode("/", trim($this->aRequests['url'])) ;
            if(count($tmp) > 1){
                $this->aRequests['controller'] = trim($tmp[0]) ;
                $this->aRequests['action'] = trim($tmp[1]) ;
                if(count($tmp) > 2){
                    $this->aRequests['params'] = array() ;
                    for($i=2; $i< count($tmp);$i++){
                        array_push($this->aRequests['params'], trim($tmp[$i])) ;
                    }
                }
            }
        }
    }
    
}
