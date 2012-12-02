<?php

class Form_Entry extends Zend_Form
{

    public function init()
    {
        $this->setName("entry-form")
             ->setMethod("post");

        $customer = new Zend_Form_Element_Text('customer');
        $customer->setLabel('Customer Name:')
                ->setRequired()                
                ->addFilters(array('StringTrim','StringToLower'))
                ->addValidator("StringLength", false, array(4, 10));

        $customer->class = "text";

        $customer->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $area = new Zend_Form_Element_Select('area');
        $area->setLabel('Area:')
                ->setRequired();
                

        $area->class = "text";
        $area->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $city = new Zend_Form_Element_Select('city');
        $city->setLabel('City:')
                ->setRequired();
                

        $city->class = "text";
        $city->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("Label"),
                array("HtmlTag", array("tag" => "div", "class" => "form-row"))
        ));

        $activity = new Zend_Form_Element_Textarea('activity');
        $activity->setLabel('Activity:')
                 ->setRequired()
                 ->setAttrib('cols', '30')
                 ->setAttrib('rows', '5')
                 ->addFilter('StringTrim', 'StringToLower');
                 

        $activity->class = "text";
        $activity->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'div', 'class' => 'form-row'))
        ));

        $result = new Zend_Form_Element_Textarea('result');
        $result->setLabel('Result:')
               ->setAttrib('cols', '30')
               ->setAttrib('rows', '5')
               ->addFilter('StringTrim', 'StringToLower');
                 

        $result->class = "text";
        $result->setDecorators(array(
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
            $customer,
            $area,
            $city,
            $activity,
            $result,            
            $submit
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));
    }

}