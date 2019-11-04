<?php

class Application_Model_UserModel
{
    public function addUser($username,$password,$role)
    {
        $table = new Application_Model_DbTable_User;
        $data = array(
            'username'          => $username,
            'password'       => $password,
            'role'           => $role
        );
        $table->insert($data);
    }
    
    public function validateUserName($username)
    {
        $validator = new Zend_Validate_Alnum();
        
    }

}

