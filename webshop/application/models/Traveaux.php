<?php


/**
 * @Entity
 * @Table(name="traveaux")
 * @package Zc\Entity
 */
class Application_Model_Traveaux
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
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $type;
    /**
     * @var Enseignant
     * @ManyToOne(targetEntity="Application_Model_Enseignant")
     * @JoinColumns({
     * @JoinColumn(name="enseignant_id",referencedColumnName="id")
     * })
     */
    private $enseignant;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

