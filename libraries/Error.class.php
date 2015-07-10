<?php
class Error {
	
	/**
	 * errors
	 */
	protected $aErrors = array() ;
	
	/**
	 * 
	 */
	protected $type ;
	
	/**
	 * urlvalues
	 */
	protected $urlvalues ;
	
	
	/**
	 * Constructor
	 */
	public function __construct($type, $urlvalues){
            $this -> type = $type ;
            $this -> urlvalues = $urlvalues ;
	}
	
	/**
	 * Execute the action
	 * 
	 */
	public function executeAction(){
		switch($this -> type){
			case "badUrl":
                            $path = "" ;
                            if(!empty($this -> urlvalues['url'])){
                                $tmp = explode('/', trim($this -> urlvalues['url'])) ;
                                if(count($tmp) > 0){
                                    for($i=0; $i< count($tmp)-1;$i++){
                                        $path .= '../' ;
                                    }
                                }
                            }
                            
                            require(APP_PATH.'global/error.php') ;
                            break;
			default:
				break ;
		}
	}
	
}
?>