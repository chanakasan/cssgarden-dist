<?php

class Form_User extends Zend_Form
{

    public function init()
    {
        $this->setName("user-form")
             ->setMethod("post");

        $firstname = new Zend_Form_Element_Text('firstname');
        $firstname->setLabel('First Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(4, 10));

        $firstname->class = "text";

        $firstname->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Last Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(4, 10));

        $lastname->class = "text";
        $lastname->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(4, 10));

        $username->class = "text";
        $username->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(4, 10));

        $password->class = "text";
        $password->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'div', 'class' => 'form-row'))
        ));

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail:')                 
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(4, 10));

        $email->class = "text";
        $email->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'div', 'class' => 'form-row'))
        ));

        $mobile = new Zend_Form_Element_Text('mobile');
        $mobile->setLabel('Mobile No.:')                 
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(4, 10));

        $mobile->class = "text";
        $mobile->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'div', 'class' => 'form-row'))
        ));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('HtmlTag', array('tag' => 'div', 'class' => 'submit-row'))
        ));


        $this->addElements(array(
            $firstname,
            $lastname,
            $username,
            $password,
            $email,
            $mobile,
            $submit
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));
    }

}