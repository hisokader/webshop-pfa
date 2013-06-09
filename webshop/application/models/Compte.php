<?php


/**
 * @Table(name="compte")
 * @Entity
 * @author anas
 */
class Application_Model_Compte implements \JsonSerializable
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
    private $login;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $password;
    /**
     * @Column(type="string",length=50,nullable=true)
     * @var string
     */
    private $email;
    /**
     * @Column(type="integer")
     * @var integer
     */
    private $isActivated;
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
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Rubrique",mappedBy="compte",cascade={"persist","remove"})
     */
    private $rubrique;
    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @OneToMany(targetEntity="Application_Model_Quote",mappedBy="compte",cascade={"persist","remove"})
     */
    private $quote;

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

