<?php

class Form_Entry extends Zend_Form
{
    protected $_doctrineContainer;

    public function init()
    {
        $this->_doctrineContainer = Zend_Registry::get("doctrine");

        $this->setName("entry-form")
             ->setMethod("post");

        $category = new Zend_Form_Element_Select("category");
        $category->class = "text";
        $category->setLabel("Customer:") 
            ->setRequired();
        $category->addMultiOptions(array(
                    0 => "Select"
                ));

      
        $customerInfo = new Zend_Form_Element_Textarea("customerInfo");
        $customerInfo->class = "text";
        $customerInfo->setLabel("Customer Info:")
                ->setRequired()
                ->setAttrib("cols", "30")
                ->setAttrib("rows", "5")
                ->addFilters(array("StringTrim","StringToLower"));                


        $visitTime = new Zend_Form_Element_Text("visitTime");
        $visitTime->class = "text";
        $visitTime->setLabel("Visiting TIme:")
                ->setRequired()
                ->addFilters(array("StringTrim","StringToLower"));                


        $area = new Zend_Form_Element_Select("area");
        $area->class = "text";
        $area->setLabel("Area:")
                ->setRequired();
        $area->addMultiOptions(array(
             0 => "Select"
        ));
        $area->setValue(0);

        $city = new Zend_Form_Element_Select("city");
        $city->class = "text";
        $city->setLabel("City:");
                //->setRequired();
        $city->addMultiOptions(array(
             0 => "Select"
        ));
        $city->setValue(0);
        
        $activity = new Zend_Form_Element_Textarea("activity");
        $activity->class = "text";
        $activity->setLabel("Activity:")
                 ->setRequired()
                 ->setAttrib("cols", "30")
                 ->setAttrib("rows", "5")
                 ->addFilter("StringTrim", "StringToLower");


        $result = new Zend_Form_Element_Select("result");
        $result->class = "text";
        $result->setLabel("Result:")
                ->setRequired(false);
        $result->addMultiOptions(array(
            "incomplete" => "incomplete",
            "success" => "success",
            "fail" => "fail",
        ));
        $result->setValue("incomplete");
        

        $remarks = new Zend_Form_Element_Textarea("remarks");
        $remarks->class = "text";
        $remarks->setLabel("Remarks:")
               ->setRequired(false)
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
            $category,
            $customerInfo,
            $visitTime,
            $area,
            $city,
            $activity,
            $result,
            $remarks
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

    public function populateCategoryList()
    {
        // retrieve customer categories list
        $em = $this->_doctrineContainer->getEntityManager();
        $result = $em->createQuery("SELECT u.id, u.name FROM App\Entity\Category u")->getResult();
        
        $catElement = $this->getElement('category');
        if(!empty($result)) // populate category select element
        {
            foreach($result as $cat)
            {
                $catElement->addMultiOptions(array(
                    $cat['id'] => $cat['name']
                ));
            }
        }

        return $this;
    }

    public function populateAreaList()
    {
        // retrieve areas list        
        $em = $this->_doctrineContainer->getEntityManager();
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

    public function update($formData)
    {
        $em = $this->_doctrineContainer->getEntityManager();
        $queryString = "UPDATE App\Entity\Entry u
                            SET u.customer = :customer,
                                u.customerInfo = :customerInfo,
                                u.visitTime = :visitTime,
                                u.area = :area,
                                u.city = :city,
                                u.activity = :activity,
                                u.result = :result,
                                u.remarks = :remarks
                            WHERE u.id = :id";

        $query = $em->createQuery($queryString);
        $query->setParameters( array(
                'id' => $this->_getParam('id'),
                'customer' => $formData['customer'],
                'customerInfo' => $formData['customerInfo'],
                'visitTime' => $formData['visitTime'],
                'area' => $formData['area'],
                'city' => $formData['city'],
                'activity' => $formData['activity'],
                'result' => $formData['result'],
                'remarks' => $formData['remarks'],
            ));
        $query->getResult();
    }

}