<?php
/**
 * Base abstract class Controller
 * All the controller class extends this abstract class
 * 
 * @author Jacky Amirel
 *
 */
abstract class BaseController {
	
	/**
	 * urls' vlaues
	 * 
	 * @access protected
	 * @var mixed $urlvalues
	 */
	protected $urlvalues;
	
	/**
	 * The action to execute
	 * 
	 * @access protected
	 * @var string $action
	 */
	protected $action;
	
	/**
	 * Varieble to set to the views
	 * 
	 * @access protected
	 * @var array $viewsVars
	 */
	protected $viewsVars = array() ;
	
	/**
	 * EntityManager for the doctrine
	 * 
	 * @access protected
	 * @var string $entityManager
	 */
	protected $entityManager ;
	
	
	/**
	 * Class constructor
	 * 
	 * @param string $action
	 * @param mixed $urlvalues
	 */
	public function __construct($action, $urlvalues) {
            $this->action = $action;
            $this->urlvalues = $urlvalues;
            
            // initialize the entityManage to be use by all child classes(Controller)
            $this -> entityManager = Doctrine::getEntityManager();
	}
	
	/**
	 * Execute the current action
	 * 
	 * @return the action method
	 */
	public function executeAction() {
            return $this->{$this->action}();
	}
	
	public function set($aVars = array()){
            $this -> viewsVars = array_merge($this -> viewsVars, $aVars) ;
	}
	
	/**
	 * Return the view
	 * 
	 * @param string $viewmodel
	 * @param string $fullview
	 */
	protected function returnView($viewmodel = false, $fullview = false) {
            $dir = str_replace("Controller", "", get_class($this)) ;
            $file = str_replace("Action", "", $this->action) ;
            $viewloc = 'application/views/' . $dir . '/' . $file . '.php';
            if ($fullview) {
                    require('application/views/Index/index.php');
            } else {
                    extract($this -> viewsVars);
                    require($viewloc);
            }
	}
	
	/**
	 * Verify data from Form
	 * 
	 * @param array $post
	 * @return array
	 */
	public function verfiDataForm($post){
		if(is_array($post)){
			foreach($post as $key => $val){
				if(is_string($val)){
					$reg= "@<script.*?(/>|>.*?</script>)@si";
					$val = preg_replace($reg,'',$val);
					$post[$key] = htmlspecialchars($val) ;
				}else{
					$post[$key] = $val ;
				}
			}
		}
		return $post ;
	}
        
        /**
         * Get the entityManager
         * @return type
         */
        public function getEntityManager(){
            return $this -> entityManager ;
        }
        
        public function setEntityManager($entityManager){
            $this -> entityManager = $entityManager ;
        }
	
}
?>