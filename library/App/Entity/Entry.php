<?php

namespace App\Entity;
/**
 *
 * @Table(name="entries")
 * @Entity
 * @author CS
 */
class Entry
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
     *
     *  @Column(type="integer")
     */
    protected $userid;

    /**
     *
     * @var integer
     * @Column(type="integer")
     */
    protected $dwpno;

    /**
     *
     * @var datetime
     * @Column(type="string", length=32)
     */
    protected $date;

    /**
     *
     * @var category
     * @Column(type="string", length=32)
     */
    protected $category;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $customerInfo;

    /**
     * @Column(type="string",length=32)
     * @var string
     */
    protected $visitTime;

    /**
     * @Column(type="string",length=32)
     * @var string
     */
    protected $area;

    /**
     * @Column(type="string",length=32)
     * @var string
     */
    protected $city;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $activity;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $result;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $remarks;
       
    
    public function  __construct(array $options = null)
    {
        $this->date = \date("Y-m-d H:i:s");
        $this->result = "incomplete";
        $this->remarks = "---";
        
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

    public function getUserid()
    {
        return $this->userid;
    }

    public function setUserid($id)
    {
        $this->userid = $id;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($name)
    {
        $this->category = $name;
        return $this;
    }

    public function getDwpno()
    {
        return $this->dwpno;
    }

    public function setDwpno($dwpno)
    {
        $this->dwpno = $dwpno;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    
    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function setActivity($activity)
    {
        $this->activity = $activity;
        return $this;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function getCustomerInfo()
    {
        return $this->customerInfo;
    }

    public function setCustomerInfo($info)
    {
        $this->customerInfo = $info;
        return $this;
    }

    public function getVisitTime()
    {
        return $this->visitTime;
    }

    public function setVisitTime($visitTime)
    {
        $this->visitTime = $visitTime;
        return $this;
    }

    public function getRemarks()
    {
        return $this->remarks;
    }

    public function setRemarks($info)
    {
        $this->remarks = $info;
        return $this;
    }


}

