<?php


/**
 * @Entity
 * @Table(name="enseignant")
 * @author anas
 */
class Application_Model_Enseignant extends Application_Model_Rubrique
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
    private $prenom;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $specialite;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $apropos;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $formation;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $experianceProfessionnel;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $competences;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $ecole;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Traveaux",mappedBy="enseignanr",cascade={"persist","remove"})
     */
    private $traveaux;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Cours",mappedBy="enseignanr",cascade={"persist","remove"})
     */
    private $cours;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_FichierEnseignant",mappedBy="Enseignant",cascade={"persist","remove"})
     */
    private $fichierenseignant;

    public function getparentId()
    {
        return parent::getId();
    }

    public function setParentNom($property, $value)
    {
        parent::setNom($property, $value);
    }

    public function setParentLien($property, $value)
    {
        parent::setNom($property, $value);
    }

    public function setParentCompte($property, $value)
    {
        parent::setCompte($property, $value);
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

