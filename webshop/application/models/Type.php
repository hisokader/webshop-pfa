<?php

/**
 * @Table(name="type")
 * @Entity
 * @author anas
 */
class Application_Model_Type
{
    /**
     *
     * @var integer $id
     * @Column(name="id",type="integer",nullable=false)
     * @id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @Column(type="string",length=50,nullable=true)
     *
     * @var string
     */
    private $nom;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Fichier",mappedBy="type",cascade={"persist","remove"})
     */
    private $fichier;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_FichierEnseignant",mappedBy="type",cascade={"persist","remove"})
     */
    private $fichierenseignant;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

