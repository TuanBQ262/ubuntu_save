<?php

class Application_Form_RegisterForm extends Zend_Form
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
        $password   ->addValidator('Alnum')
                    // ->addValidator('NotEmpty', true, array('messages'=>'This field not empty'))
                    ->addValidator('StringLength', false, array(6, 20));
        $re_password = $this->createElement("password","re-password",array(
            "label" => "re-password",
            "required"=> true,
        ));
        $re_password->addValidator('Identical', false, array('token' => 'password'));

        $role = $this->createElement("text","role",array(
            "label" => "role",
            "required"=> true,
        ));
        $role->addValidator('Digits');
        $submit=$this->createElement("submit","Login");  
        $this->addElements(array($username,$password,$re_password,$role,$submit));
    }


}

