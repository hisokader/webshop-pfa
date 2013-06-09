<?php


/**
 * @Table(name="entreprise")
 * @Entity
 * @author anas
 */
class Application_Model_Entreprise extends Application_Model_Rubrique
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
    private $apropos;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $email;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $mission;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Realisation",mappedBy="realisation",cascade={"persist","remove"})
     */
    private $realisation;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Offre",mappedBy="offre",cascade={"persist","remove"})
     */
    private $offre;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_FichierEntreprise",mappedBy="Entreprise",cascade={"persist","remove"})
     */
    private $fichierentreprise;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}

