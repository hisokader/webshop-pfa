<?php


/**
 * @Table(name="conception")
 * @Entity
 * @author anas
 */
class Application_Model_Conception
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
     * @var string
     */
    private $nom;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $description;
    /**
     * @var Projet
     * @ManyToOne(targetEntity="Application_Model_Projet")
     * @JoinColumns({
     * @JoinColumn(name="projet_id",referencedColumnName="id")
     * })
     */
    private $projet;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}

