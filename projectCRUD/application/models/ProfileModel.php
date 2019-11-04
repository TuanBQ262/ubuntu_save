<?php

class Application_Model_ProfileModel
{

    public function getAllProfile()
    {
        $table = new Application_Model_DbTable_Profile;
        return $table->fetchAll();
    }

    public function delProfile($id)
    {
        $table = new Application_Model_DbTable_Profile;
        $table->delete('id = '.$id);
    }

    public function editProfile($id,$name,$email,$age)
    {
        $table = new Application_Model_DbTable_Profile;
        $data = array(
            'name'          => $name,
            'email'       => $email,
            'age'           => $age
        );
        $table->update($data, 'id = '.$id);
    }

    public function searchProfile($key)
    {
        $table = new Application_Model_DbTable_Profile;
        if($key==''){
            $where = $table->fetchAll();
        }
        $where = $table->select()->where('name LIKE ?', $key.'%');
        return $where;
    }
    public function getProfileByID($id)
    {
        $table = new Application_Model_DbTable_Profile;
        return $table->fetchRow('id = '.$id);
    }

    public function addProfile($name,$email,$age)
    {
        $table = new Application_Model_DbTable_Profile;
        $data = array(
            'name'          => $name,
            'email'       => $email,
            'age'           => $age
        );
        $table->insert($data);
    }

}

