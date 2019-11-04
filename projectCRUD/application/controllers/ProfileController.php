<?php

class ProfileController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $auth   = Zend_Auth::getInstance();
        $this->view->baseUrl = $this->view->baseUrl();
        $username = $auth->getStorage()->read()->username;
        $this->view->headerContent = 'Xin chào ' . $username . ' <a href="/user/logout">Đăng xuất</a>';
    }
    function preDispatch()
    {
        $auth   = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->redirect('/user/login');
            return;
        }
    }

    public function indexAction()
    {
        $this->redirect('/profile/list');
    }
    public function createAction()
    {
        $request = $this->getRequest();
        $model = new Application_Model_ProfileModel;
        $form = new Application_Form_AddForm;
        $this->view->createForm = $form;
        $this->view->headTitle = 'Tạo profile';
        $this->view->titlePage = 'Tạo profile';

        if (!$request->isPost()) {
            return;
        }
        $name = $request->getPost('name');
        $email = $request->getPost('email');
        $age = $request->getPost('age');
        $avatar  = $form->avatar->getFileName();
        echo($avatar);

        // $model->addProfile($name, $email, $age);
        // return $this->redirect('/profile/list');
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $model = new Application_Model_ProfileModel;
        $form = new Application_Form_EditForm;
        $this->view->editForm = $form;
        $this->view->headTitle = 'Sửa profile';
        $this->view->titlePage = 'Sửa profile';

        $id = $request->getParam('id', "");
        if ($id === null) {
            return $this->redirect('/profile');
        }

        $profile =  $model->getProfileByID($id);
        $form->name->setValue($profile->name);
        $form->email->setValue($profile->email);
        $form->age->setValue($profile->age);

        if (!$request->isPost()) {
            return;
        }
        $name = $request->getPost('name');
        $email = $request->getPost('email');
        $age = $request->getPost('age');

        $model->editProfile($id, $name, $email, $age);
        return $this->redirect('/profile');
    }
    public function delAction()
    {
        $id = $this->_request->getParam('id', "");
        if ($id === null) {
            $this->redirect('/profile');
        }
        $model = new Application_Model_ProfileModel;
        $model->delProfile($id);
        $this->redirect('/profile');
    }

    public function listAction()
    {
        $this->view->headTitle = 'List profile';
        $this->view->titlePage = 'List profile';
        $form_search = new Application_Form_Search;
        $this->view->form_search = $form_search;

        $model = new Application_Model_ProfileModel;
        $all_profile = $model->getAllProfile();

        if ($form_search->isValid($_GET)) {
            $key = $this->getRequest()->getQuery('key');
            $all_profile = $model->searchProfile($key);
        }

        $paginator = $this->_paginator($all_profile);
        $this->view->paginator = $paginator;
    }

    public function _paginator($data)
    {
        $paginator = Zend_Paginator::factory($data);
        $paginator->setItemCountPerPage(5);
        $paginator->setPageRange(3);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        return $paginator;
    }
}
