<?php

class PersonController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        return $this->redirect('/person/read');
    }

    public function delAction()
    {
        $request = $this->getRequest();
        $id = $request->getQuery('id');
        if ($id == ""){
            return $this->redirect('/person/read');
        } else {
        $tbl_person = new Application_Model_PersonDBTable();
        $tbl_person->delete('id = '.$id);
        return $this->redirect('/person/read');
        }
        
    }

    public function addAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            $name = $request->getPost('txtName');
            $address = $request->getPost('txtAddress');
            $age = $request->getPost('txtAge');
            $tbl_person = new Application_Model_PersonDBTable();
            $new_person = array(
                'name'      => $name,
                'address' => $address,
                'age'      => $age
            );
            $tbl_person->insert($new_person);
            return $this->redirect('/person/read');
        }
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $request->getQuery('id');
        if ($id == ""){
            return $this->redirect('/person/read');
        } else {
        $tbl_person = new Application_Model_PersonDBTable();
        $person =  $tbl_person->fetchRow('id = '.$id);
        $this->view->person= $person;       
        }

        $request = $this->getRequest();
        if ($request->isPost()){
            $name = $request->getPost('txtName');
            $address = $request->getPost('txtAddress');
            $age = $request->getPost('txtAge');

            $data = array(
                'name'          => $name,
                'address'       => $address,
                'age'           => $age
            );
            $tbl_person->update($data, 'id = '.$id);
            return $this->redirect('/person/read');
        } 
    }

    public function readAction()
    {

        $tbl_person = new Application_Model_PersonDBTable();
        $persons =  $tbl_person->fetchAll();
        $this->view->persons= $persons;

    }

    public function listAction()
    {
        // action body
    }


}











