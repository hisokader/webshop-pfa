<?php

/**
 * @Table(name="quote")
 * @Entity
 * @author anas
 */
class Application_Model_Quote
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
    private $text;
    /**
     *  @Column(type="boolean")
     *  @var boolean
     */
    private $isActivated;
    /**
     * @var Compte
     * @ManyToOne(targetEntity="Application_Model_Compte")
     * @JoinColumns({
     * @JoinColumn(name="compte_id",referencedColumnName="id")
     * })
     */
    private $compte;

    public function jsonSerialize()
    {
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && method_exists($value, 'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
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

