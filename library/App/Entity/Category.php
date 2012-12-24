<?php

namespace App\Entity;
/**
 *
 * @Table(name="categories")
 * @Entity
 * @author CS
 */
class Category
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
     * @Column(type="string",length=64)
     * @var string
     */
    protected $descrip;

    /**
     *
     * @var boolean
     * @Column(type="boolean")
     */
    protected $isactive;    
    
    /**
     *
     * @param array $options
     */
    public function  __construct(array $options = null)
    {        
        $this->descrip = "---";
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDescrip()
    {
        return $this->descrip;
    }

    public function setDescrip($info)
    {
        $this->descrip = $info;
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

    public function setIsactive($state)
    {
        $this->isactive = $state;
        return $this;
    }
    

}

