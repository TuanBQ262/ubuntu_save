<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $username = $this->createElement("text","username",array(
            "label" => "username",
            "required"=> true,
        ));
        $password = $this->createElement("password","password",array(
            "label" => "password",
            "required"=> true,
        ));
        $submit=$this->createElement("submit","Login");  
        $this->addElements(array($username,$password,$submit));
    }


}

