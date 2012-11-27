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
     * @Column(name="id", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(type="string",length=60,nullable=false)
     * @var string
     *
     */
    protected $username;
    /**
     * @Column(type="string",length=60,nullable=false)
     * @var string
     * 
     */
    protected $fname;

    /**
     * @Column(type="string",length=60,nullable=false)
     * @var string
     */
    protected $lname;

    /**
     * @Column(type="string",length=60,nullable=false)
     * @var string
     */
    protected $email;

    public function  __construct(array $options = null)
    {
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
            throw new Exception('Invalid '. get_class($this) .' property.');
        }
        return $this->$method($value);
    }

    public function  __get($name)
    {
        $method = 'get'.$name;
        if('mapper' == $name || !method_exists($this, $method))
        {
            throw new Exception('Invalid '. get_class($this) .' property.');
        }
        return $this->$method();
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


}

