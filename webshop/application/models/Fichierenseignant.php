<?php


/**
 * @Table(name="fichierenseignant")
 * @Entity
 * @author anas
 */
class Application_Model_Fichierenseignant
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
    private $lien;
    /**
     * @var Enseignant
     * @ManyToOne(targetEntity="Application_Model_Enseignant")
     * @JoinColumns({
     * @JoinColumn(name="enseignant_id",referencedColumnName="id")
     * })
     */
    private $enseignant;
    /**
     * @var Type
     * @ManyToOne(targetEntity="Application_Model_Type")
     * @JoinColumns({
     * @JoinColumn(name="type_id",referencedColumnName="id")
     * })
     */
    private $type;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

