<?php
/**
 * Class IndexController
 * DefaultController
 * 
 * @author Jacky Amirel
 *
 */
class IndexController extends BaseController {
	
	/**
	 * Class constructor
	 */
	public function __construct($action, $urlvalues){
            parent::__construct($action, $urlvalues);	
	}
	
	/**
	 * Action index
	 */
	protected function indexAction() {
            $this->returnView();
	}
	
}
?>