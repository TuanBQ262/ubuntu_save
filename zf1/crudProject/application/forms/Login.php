<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {

        $this->setAction('')
            ->setMethod('post');
        $username = $this->createElement("text","username",array(
            "label" => "username"
        ));
        $username ->setRequired(true);

        $password = $this->createElement("password","password",array(
            "label" => "password"
        ));
        $password->addValidator('StringLength', false, array(6))
                ->setRequired(true);
        $submit=$this->createElement("submit","login");  
        $this->addElements(array($username,$password,$submit));
    }


}

