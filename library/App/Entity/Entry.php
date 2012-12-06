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
     * @Column(name="id", type="integer", length=11)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11)
     */
    protected $dwpno;

    /**
     *
     * @var datetime
     * @Column(type="string", length=30)
     */
    protected $date;

    /**
     * @Column(type="string",length=30)
     * @var string
     */
    protected $customer;

    /**
     * @Column(type="string",length=60)
     * @var string
     */
    protected $customerInfo;

    /**
     * @Column(type="string",length=30)
     * @var string
     */
    protected $visitTime;

    /**
     * @Column(type="string",length=30)
     * @var string
     */
    protected $area;

    /**
     * @Column(type="string",length=30)
     * @var string
     */
    protected $city;

    /**
     * @Column(type="string",length=100)
     * @var string
     */
    protected $activity;

    /**
     * @Column(type="string",length=100)
     * @var string
     */
    protected $result;

    /**
     *
     * @var User
     * @ManyToOne(targetEntity="User")
     * @JoinColumns({
     *  @JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;

    
    public function  __construct(array $options = null)
    {
        $this->date = \date("Y-m-d H:i:s");
        $this->result = "---";
        
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

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
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
}

