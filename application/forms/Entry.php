<?php

class Form_Entry extends Zend_Form
{

    public function init()
    {
        $this->setName("entry-form")
             ->setMethod("post");

        $customer = new Zend_Form_Element_Text("customer");
        $customer->class = "text";
        $customer->setLabel("Customer Name:")
                ->setRequired()                
                ->addFilters(array("StringTrim","StringToLower"))
                ->addValidator("StringLength", false, array(4, 10));
        
        $customerInfo = new Zend_Form_Element_Textarea("customerInfo");
        $customerInfo->class = "text";
        $customerInfo->setLabel("Customer Info:")
                ->setRequired()
                ->setAttrib("cols", "30")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"))
                ->addValidator("StringLength", false, array(4, 10));


        $visitTime = new Zend_Form_Element_Text("visitTime");
        $visitTime->class = "text";
        $visitTime->setLabel("Visiting TIme:")
                ->setRequired()
                ->addFilters(array("StringTrim","StringToLower"))
                ->addValidator("StringLength", false, array(4, 10));


        $area = new Zend_Form_Element_Select("area");
        $area->addMultiOptions(array(
            "1" => "colombo",
            "2" => "gampaha",
            "3" => "kaluthara",
        ));
        $area->setValue("colombo");
        $area->class = "text";
        $area->setLabel("Area:")
                ->setRequired();


        $city = new Zend_Form_Element_Select("city");
        $city->addMultiOptions(array(
            "1" => "colombo 10",
            "2" => "colombo 11",
            "3" => "colombo 12",
        ));
        $city->setValue("colombo 10");
        $city->class = "text";
        $city->setLabel("City:")
                ->setRequired();
                
        $activity = new Zend_Form_Element_Textarea("activity");
        $activity->class = "text";
        $activity->setLabel("Activity:")
                 ->setRequired()
                 ->setAttrib("cols", "30")
                 ->setAttrib("rows", "5")
                 ->addFilter("StringTrim", "StringToLower");
               
        $result = new Zend_Form_Element_Textarea("result");
        $result->setAttrib("disabled", "disabled")
                ->setValue("---");

        $result->class = "text";
        $result->setLabel("Result:")
               ->setAttrib("cols", "30")
               ->setAttrib("rows", "5")
               ->addFilter("StringTrim", "StringToLower");
 
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("HtmlTag", array("tag" => "div", "class" => "submit-row"))
        ));

        $elements = array(
            $customer,
            $customerInfo,
            $visitTime,
            $area,
            $city,
            $activity,
            $result
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
            "FormElements",
            array("HtmlTag", array("tag" => "div")),
            "Form"
        ));
        
    }

}