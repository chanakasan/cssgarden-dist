<?php
namespace App\Entity;
/**
 *
 * @Table(name="users")
 * @Entity
 * @author CS
 */
class User
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
     * @Column(type="string",length=32, unique=true)
     * @var string
     *
     */
    protected $username;

    /**
     * @Column(type="string",length=32)
     * @var string
     * 
     */
    protected $password;

    /**
     * @Column(type="string",length=32)
     * @var string
     *
     */
    protected $fname;

    /**
     * @Column(type="string",length=32)
     * @var string
     */
    protected $lname;

    /**
     * @Column(type="string",length=64)
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string",length=32)
     * @var integer
     */
    protected $mobile;

    /**
     * @Column(type="boolean")
     * @var boolean
     */
    protected $isactive;

    /**
     * @Column(type="boolean")
     * @var boolean
     */
    protected $isadmin;

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $property
     *
     * @OneToMany(targetEntity="Entry", mappedBy="user", cascade={"persist","remove"})
     */
    protected $entries;

    
    public function  __construct(array $options = null)
    {
        $this->isactive = true;
        $this->isadmin = false;
        $this->entries = new \Doctrine\Common\Collections\ArrayCollection();
        
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
        if(!method_exists($this, $method))
        {
            throw new \Exception('Invalid '. \get_class($this) .' property.');
        }
        return $this->$method();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function setEntries($data)
    {
        $this->entries = $data;
        return $this;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($text)
    {
        $this->username = (string) $text;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setFname($text)
    {
        $this->fname = (string) $text;
        return $this;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function setLname($text)
    {
        $this->lname = (string) $text;
        return $this;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
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

    public function getIsadmin()
    {
        return $this->isadmin;
    }

    public function setIsadmin($state)
    {
        $this->isadmin = $state;
        return $this;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile_no)
    {
        $this->mobile = $mobile_no;
        return $this;
    }
}

