<?php

class Form_Customer extends Zend_Form
{
    
    public function init()
    {
        $this->setName("customer-form")
             ->setMethod("post");

        $name = new Zend_Form_Element_Text("name");
        $name->class = "text";
        $name->setLabel("Name:")
                ->setValue(false)
                ->setRequired()                
                ->addFilters(array("StringTrim","StringToLower"));
                
        
        $address = new Zend_Form_Element_Textarea("address");
        $address->class = "text";
        $address->setLabel("Address:")
                ->setAttrib("cols", "18")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"));

        $phones = new Zend_Form_Element_Textarea("phones");
        $phones->class = "text";
        $phones->setLabel("Phones:")
                ->setAttrib("cols", "18")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"));

        $details = new Zend_Form_Element_Textarea("details");
        $details->class = "text";
        $details->setLabel("Details:")
                ->setAttrib("cols", "18")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"));

        $area = new Zend_Form_Element_Select("area");
        $area->class = "text";
        $area->setLabel("Area:")
                ->setRequired();
        $area->addMultiOptions(array(
             0 => "Select"
        ));

        $city = new Zend_Form_Element_Select("city");
        $city->class = "text";
        $city->setLabel("City:")
              ->setRequired()
              ->setRegisterInArrayValidator(false);
        $city->addMultiOptions(array(
             0 => "Select"
        ));

        $isactive = new Zend_Form_Element_Checkbox('isactive');
        $isactive->class = "text";
        $isactive->setLabel("Active")
                ->setValue(true);
                
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                "ViewHelper",
                "Description",
                "Errors",
                array("HtmlTag", array("tag" => "div", "class" => "submit-row"))
        ));

        $elements = array(
            $name,
            $address,
            $phones,
            $details,
            $area,
            $city,
            $isactive
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

        // hidden element to save the return url
        $this->addElement('hidden', 'return', array(
    	'value' => Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(),
    		));
        // add data elements
        $this->addElements($elements);
        // add submit buttons
        $this->addElement($submit);

        // populate area select list
        $this->populateAreaList();

        $this->setDecorators(array(
            "FormElements",
            array("HtmlTag", array("tag" => "div")),
            "Form"
        ));
        
    }

    protected function populateAreaList()
    {        
        $doctrineContainer = Zend_Registry::get("doctrine");
        $em = $doctrineContainer->getEntityManager();
        // retrieve areas from table
        $result = $em->createQuery("SELECT u.id, u.name FROM App\Entity\Area u")->getResult();

        $areaElement = $this->getElement('area');
        if(!empty($result)) // populate area select element
        {
            foreach($result as $area)
            {
                $areaElement->addMultiOptions(array(
                    $area['id'] => $area['name']
                ));
            }
        }
        return $this;
    }

}