<?php

class Application_Form_EditForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod("post")
            ->setAction("");
        $name= $this->createElement("text","name",array(
            "label" => "name"
        ));
        $email= $this->createElement("text","email",array(
            "label" => "email"
        ));
        $age= $this->createElement("text","age",array(
            "label" => "age"
        ));
        $age->addValidator('Digits');
        $avatar= $this->createElement("file","avatar",array(
            "label"=>"avatar",
        ));
        $submit= $this->createElement("submit","Sửa");


        $this->addElements(array($name,$email,$age,$avatar,$submit));

    }


}

