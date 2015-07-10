<?php
/**
 * Class Router
 * 
 * @author Jacky Amirel
 */
class Router {
	
	private $controller;
	private $action;
	private $urlvalues;
        private $params = array() ;
	
	//store the URL values on object creation
	public function __construct($urlvalues) {
            $this->urlvalues = $urlvalues;
            
            if ($this->urlvalues['controller'] == "") {
                $this->controller = "IndexController";
            } else {
                $this->controller = ucfirst($this->urlvalues['controller']) . "Controller";
            }
            
            if ($this->urlvalues['action'] == "") {
                $this->action = "indexAction";
            } else {
                $this->action = $this->urlvalues['action'] . "Action";
            }
            
            if (!empty($this->urlvalues['params'])) {
                $this->params = $this->urlvalues['params']     ;
            }
                
	}
	
	//establish the requested controller as an object
	public function dispatchAndExecute() {
		//does the class exist?
		if (class_exists($this->controller)) {
			$parents = class_parents($this->controller);
			//does the class extend the controller class?
			if (in_array("BaseController",$parents)) {
				//does the class contain the requested method?
				if (method_exists($this->controller,$this->action)) {
					$controller = new $this->controller($this->action,$this->params);                                        
				} else {
					//bad method error
					$controller =  new Error("badUrl",$this->urlvalues);
				}
			} else {
				//bad controller error
				$controller =  new Error("badUrl",$this->urlvalues);
			}
		} else {
			//bad controller error
			$controller =  new Error("badUrl",$this->urlvalues);
		}
                
            $controller -> executeAction() ;
	}
	
}
?>