<?php

class Application_Form_AddForm extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $name = $this->createElement('text', 'name', array(
            'label' => 'name'
        ));
        $email = $this->createElement('text', 'email', array(
            'label' => 'email'
        ));
        $age = $this->createElement('text', 'age', array(
            'label' => 'age'
        ));
        $age->addValidator('Alnum')
            ->addValidator('Digits');
        $avatar = $this->createElement("file", "avatar", array(
            "label" => "avatar",
        ));
        $submit = $this->createElement('submit', 'create');


        $this->addElements(array($name, $email, $age,$avatar, $submit));
    }
}
