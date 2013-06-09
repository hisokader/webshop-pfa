<?php


/**
 * @Table(name="filliere")
 * @Entity
 * @author anas
 */
class Application_Model_Filliere
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
    private $description;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $objectif;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $conditionDacces;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $partenaria;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $coordinateur;
    /**
     * @var Ecole
     * @ManyToOne(targetEntity="Application_Model_Ecole")
     * @JoinColumns({
     * @JoinColumn(name="ecole_id",referencedColumnName="id")
     * })
     */
    private $ecole;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

