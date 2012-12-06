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
     * @Column(name="id", type="integer", length=11)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(type="string",length=30)
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string",length=60)
     * @var string
     */
    protected $desc;

    /**
     *
     * @var string
     * @Column(type="string", length=30)
     */
    protected $created;

    /**
     *
     * @var boolean
     * @Column(type="boolean")
     */
    protected $isactive;
    
    
    public function  __construct(array $options = null)
    {
        $this->created = \date("Y-m-d H:i:s");
        $this->desc = "---";
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

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($date)
    {
        $this->created = $date;
        return $this;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($info)
    {
        $this->desc = $info;
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

