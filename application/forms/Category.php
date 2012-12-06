<?php

class Form_Category extends Zend_Form
{

    public function init()
    {
        $this->setName("cat-form")
             ->setMethod("post");

        $catName = new Zend_Form_Element_Text("cat-name");
        $catName->class = "text";
        $catName->setLabel("Customer Name:")
                ->setRequired()                
                ->addFilters(array("StringTrim","StringToLower"));
                
        
        $desc = new Zend_Form_Element_Textarea("cat-desc");
        $desc->class = "text";
        $desc->setLabel("Customer Info:")
                ->setRequired()
                ->setAttrib("cols", "30")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"));
                
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("HtmlTag", array("tag" => "div", "class" => "submit-row"))
        ));

        $elements = array(
            $catName,
            $desc
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