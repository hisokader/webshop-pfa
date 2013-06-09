<?php


/**
 * @Table(name="message")
 * @Entity
 * @author anas
 */
class Application_Model_Message
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
    private $prenom;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $email;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $objet;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $message;
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

