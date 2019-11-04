<?php

class Application_Form_Search extends Zend_Form
{

    public function init()
    {
        $this->setMethod('get');
        $key = $this->createElement("text","key",array(
            "label" => "search"
        ));
        $this->addElements(array($key));
    }


}

