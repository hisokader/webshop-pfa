<?php


/**
 * @Table(name="contact")
 * @Entity
 * @author anas
 */
class Application_Model_Contact
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
    private $talephonePortable;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $telephoneFix;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $fax;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $email;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $adresse;
    /**
     * @var Rubrique
     * @ManyToOne(targetEntity="Application_Model_Rubrique")
     * @JoinColumns({
     * @JoinColumn(name="rubrique_id",referencedColumnName="id")
     * })
     */
    private $rubrique;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}

