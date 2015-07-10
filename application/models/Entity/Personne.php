<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="personnes")
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property date $dateNaissance
 * @property string $adresse
 * 
 * @author Jacky Amirel
 */
class Personne {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id 
     */
    private $id ;
    
    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    private $nom;
    
    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    private $prenom ;
    
    /**
     * @ORM\Column(type="integer")
     * @var type 
     */
    private $age ;
    
    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    private $adresse ;
    
    
    /**************** Getters *****************/
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getAge() {
        return $this->age;
    }

    public function getAdresse() {
        return $this->adresse;
    }
    
    /************* Setters ****************/
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    /**
     * Exchange array to append into the object
     * @param array $datas
     */
    public function exchangeArray(array $datas) {
        $this -> id = (!empty($datas['id'])) ? $datas['id'] : null ;
        $this -> nom = (!empty($datas['nom'])) ? $datas['nom'] : null ;
        $this -> prenom = (!empty($datas['prenom'])) ? $datas['prenom'] : null ;
        $this -> age = (!empty($datas['age'])) ? $datas['age'] : null ;
        $this -> adresse = (!empty($datas['adresse'])) ? $datas['adresse'] : null ;
    }
    
}
