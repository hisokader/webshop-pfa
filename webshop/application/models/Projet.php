<?php


/**
 * @Entity
 * @Table(name="projet")
 */
class Application_Model_Projet extends Application_Model_Rubrique
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
    private $license;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $remerciement;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_FichierProjet",mappedBy="Projet",cascade={"persist","remove"})
     */
    private $fichierprojet;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

