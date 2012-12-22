<?php
namespace App\Entity;
/**
 *
 * @Table(name="areas")
 * @Entity
 * @author CS
 */
class Area
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
      * @Column(type="string", length=32, unique=true)
      */
    protected $name;

     /**
      * @var boolean
      * @Column(type="boolean")
      */
    protected $isactive;

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $property
     *
     * @OneToMany(targetEntity="City",mappedBy="area", cascade={"persist","remove"})
     */
    protected $cities;

    public function  __construct(array $options = null)
    {
        $this->isactive = true;        
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();

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



}

