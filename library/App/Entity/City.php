<?php
namespace App\Entity;
/**
 *
 * @Table(name="cities")
 * @Entity
 * @author CS
 */
class City
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
      * @var string
      * @Column(type="string", length=32)
      */
    protected $name;

     /**
      * @var boolean
      * @Column(type="boolean")
      */
    protected $isactive;

    /**
     *
     * @var Area
     * @ManyToOne(targetEntity="Area")
     * @JoinColumns({
     *  @JoinColumn(name="area_id", referencedColumnName="id")
     * })
     */
    protected $area;

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $property
     *
     * @OneToMany(targetEntity="Doctor", mappedBy="city", cascade={"persist","remove"})
     */
    protected $doctors;

    
    public function  __construct(array $options = null)
    {
        $this->isactive = true;
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->supermarkets = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->salons = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->pharmacies = new \Doctrine\Common\Collections\ArrayCollection();

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

    public function __get($name)
    {
        $method_name = 'get'.$name;
        if(!method_exists($this, $method_name))
        {
            throw new \Exception('Invalid '. \get_class($this)) .' property.';
        }
        return $this->$method_name();
    }

    public function __set($name, $value)
    {
       $method_name = 'set'.$name;
       if(!method_exists($this, $method_name))
       {
           throw new \Exception('Invalid '. \get_class($this)) .' property.';
       }
       return $this->$method_name();
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

    public function getIsactive()
    {
        return $this->isactive;
    }

    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;
        return $this;
    }
    
    public function getArea()
    {
        return $this->area;
    }

    public function setArea($data)
    {
        $this->area = $data;
        return $this;
    }

    public function getDoctors()
    {
        return $this->doctors;
    }

    public function setDoctors($doctors)
    {
        $this->doctors = $doctors;
        return $this;
    }

    public function getSupermarkets()
    {
        return $this->supermarkets;
    }

    public function setSupermarkets($supermarkets)
    {
        $this->supermarkets = $supermarkets;
        return $this;
    }

    public function getSalons()
    {
        return $this->salons;
    }

    public function setSalons($salons)
    {
        $this->salons = $salons;
        return $this;
    }

    public function getPharmacies()
    {
        return $this->pharmacies;
    }

    public function setPharmacies($pharmacies)
    {
        $this->pharmacies = $pharmacies;
        return $this;
    }



}

