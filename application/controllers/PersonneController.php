<?php

use Entity\Personne;

/**
 * Description of PersonneController
 * Example of controller
 *
 * @author Jacky Amirel
 */
class PersonneController extends BaseController {
    
    public function indexAction(){
        // get the entityManager object from the parent class (abstract class BaseController)
        $entityManager = $this ->getEntityManager() ;
        $this -> viewsVars = array('listePersonnes' => $entityManager -> getRepository('Entity\Personne') -> findAll()) ;
        $this->returnView();
    }
    
    /**
     * Add on personne (juste pour test mais on doit faire un formulaire en réalité)
     */
    public function addAction(){
        $personne = new Personne();
        $personne->setNom("nom2");
        $personne->setPrenom("prenom2");
        $personne->setAge(18);
        $personne->setAdresse("120, rue calandare");
        
        $this->getEntityManager()->persist($personne);
        $this->getEntityManager()->flush();
    }
    
    /**
     * Delete une personne en passant l'id sur url
     * ex: URL de la forme: personne/delete/7
     */
    public function deleteAction(){
        $id = (int)$this -> urlvalues[0] ;
        if($id > 0){
            $personne = $this ->getEntityManager()-> find("Entity\Personne", $id) ;
            if(!empty($personne)){
                $this ->getEntityManager() -> remove($personne) ;
                $this ->getEntityManager() -> flush() ;
            }
        }
    }
    
}
