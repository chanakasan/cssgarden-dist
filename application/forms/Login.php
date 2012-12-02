<?php

class Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName("login-form")
            ->setMethod('post');
             
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilters(array('StringTrim', 'StringToLower'))
                 ->addValidator('StringLength', false, array(4, 10));

        $username->class = "text";        
        $username->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'div', 'class' => 'form-row'))
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
        
        $submit = new Zend_Form_Element_Submit('Login');
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('HtmlTag', array('tag' => 'div', 'class' => 'submit-row'))
        ));


        $this->addElements(array(
            $username,
            $password,
            $submit
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));

    }


}