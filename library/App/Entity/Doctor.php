<?php
namespace App\Entity;

/**
 * @Table(name="tbl_doctors")
 * @Entity
 * @author CS
 */
class Doctor
{
    /**
     *
     * @var integer $id
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(type="string", length=32, unique=true)
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", length=64)
     * @var string
     */
    protected $address;

    /**
     * @Column(type="string", length=64)
     * @var string
     */
    protected $phones;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $details;

    /**
     *
     * @var boolean
     * @Column(type="boolean")
     */
    protected $isactive;

    /**
     *     
     * @ManyToOne(targetEntity="City", inversedBy="doctors")
     * @JoinColumns({
     *  @JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    protected $city;
    
    
    /**
     *
     * @param array $options
     */
    public function  __construct(array $options = null)
    {
        $this->address = "---";
        $this->phones = "---";
        $this->details = "---";
        $this->isactive = true;

        if(is_array($options)) {
            $this->setOptions($oprions);
        }
    }

    private function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach($options as $key => $val)
        {
            $method = 'set'.ucfirst($key);
            if(in_array($method, $methods))
            {
                $this->$method($val);
            }
        }
        return $this;
    }

    public function  __set($name,  $value)
    {
        $method = 'set'.$name;
        if('mapper' == $name || !method_exists($this, $method))
        {
            throw new \Exception('Invalid '. \get_class($this) .' property.');
        }
        return $this->$method($value);
    }

    public function  __get($name)
    {
        $method = 'get'.$name;
        if('mapper' == $name || !method_exists($this, $method))
        {
            throw new \Exception('Invalid '. \get_class($this) .' property.');
        }
        return $this->$method();
    }

    public function toArray()
    {
       return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
       return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function setPhones($phones)
    {
        $this->phones = $phones;
        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    public function getIsactive()
    {
        return $this->isactive;
    }

    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($details)
    {
        $this->city = $details;
        return $this;
    }
    
}

