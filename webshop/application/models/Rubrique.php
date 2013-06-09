<?php


/**
 * @Entity
 * @Table(name="rubrique")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"rubrique" = "Application_Model_Rubrique", "enseignant" = "Application_Model_Enseignant", "ecole" = "Application_Model_Ecole", "entreprise" = "Application_Model_Entreprise", "projet" = "Application_Model_Projet"})
 * @author anas
 */
class Application_Model_Rubrique
{
    /**
     * @var integer $id
     * @Column(name="id",type="integer",nullable=false)
     * @id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $nom;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $lien;
    /**
     * @var Compte
     * @ManyToOne(targetEntity="Application_Model_Compte")
     * @JoinColumns({
     * @JoinColumn(name="compte_id",referencedColumnName="id")
     * })
     */
    private $compte;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Fichier",mappedBy="Rubrique",cascade={"persist","remove"})
     */
    private $fichier;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Partenaire",mappedBy="partenaire",cascade={"persist","remove"})
     */
    private $partenaire;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Contact",mappedBy="contact",cascade={"persist","remove"})
     */
    private $contact;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Message",mappedBy="message",cascade={"persist","remove"})
     */
    private $message;

    function getJsonData()
    {
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && method_exists($value, 'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNom($property, $value)
    {
        $this->$property = $value;
    }
    public function setLien($property, $value)
    {
        $this->$property = $value;
    }
    public function setCompte($property, $value)
    {
        $this->$property = $value;
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

