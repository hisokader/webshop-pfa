<?php



/**
 * @Table(name="ecole")
 * @Entity
 * @author anas
 */
class Application_Model_Ecole extends Application_Model_Rubrique
{
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $nom;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $presentation;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $motDirecteur;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Offre",mappedBy="offre",cascade={"persist","remove"})
     */
    private $offre;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Evenement",mappedBy="evenement",cascade={"persist","remove"})
     */
    private $evenement;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Filliere",mappedBy="filliere",cascade={"persist","remove"})
     */
    private $filliere;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_FichierEcole",mappedBy="ecole",cascade={"persist","remove"})
     */
    private $fichierecole;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

