<?php

class Form_User extends Zend_Form
{

    public function init()
    {
        $this->setName("user-form")
             ->setMethod("post");

        $firstname = new Zend_Form_Element_Text('fname');
        $firstname->setLabel('First Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(2, 20));
        $firstname->class = "text";


        $lastname = new Zend_Form_Element_Text('lname');
        $lastname->setLabel('Last Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(2, 20));
        $lastname->class = "text";


        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User Name:')
                ->setRequired()
                ->setAttrib('size', '20')
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(4, 10));
        $username->class = "text";


        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(6, 10));
        $password->class = "text";

        $password2 = new Zend_Form_Element_Password('password2');
        $password2->setLabel('Confirm Password:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(6, 10));
        $password2->class = "text";


        $isactive = new Zend_Form_Element_Checkbox('isactive');
        $isactive->setLabel('Active:')
                ->setValue(true);

        $isadmin = new Zend_Form_Element_Checkbox('isadmin');
        $isadmin->setLabel('Admin Rights:')
                ->setValue(false);


        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower');
        $email->class = "text";


        $mobile = new Zend_Form_Element_Text('mobile');
        $mobile->setLabel('Mobile No.:')
                 ->setRequired()
                 ->setAttrib('size', '30')                                  
                 ->addValidator('StringLength', false, array(9, 10));
        $mobile->class = "text";


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('HtmlTag', array('tag' => 'div', 'class' => 'submit-row'))
        ));

        $elements = array(
            $firstname,
            $lastname,
            $username,
            $password,
            $password2,
            $isactive,
            $isadmin,
            $email,
            $mobile         
        );
        foreach($elements as $element)
        {
            $element->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
            ));
        }

        // add data elements
        $this->addElements($elements);
        // add submit buttons
        $this->addElement($submit);

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));
    }

}