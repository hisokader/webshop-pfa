<?php


/**
 * @Table(name="offre")
 * @Entity
 * @author anas
 */
class Application_Model_Offre
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
     * @var Entreprise
     * @ManyToOne(targetEntity="Application_Model_Entreprise")
     * @JoinColumns({
     * @JoinColumn(name="entreprise_id",referencedColumnName="id")
     * })
     */
    private $entreprise;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

