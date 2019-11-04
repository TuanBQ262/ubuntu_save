<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    { }

    public function loginAction()
    {
        $form = new Application_Form_LoginForm;
        $this->view->loginForm = $form;
        $this->view->headTitle = 'Đăng nhập';
        $this->view->titlePage = 'Đăng nhập';
        $this->view->headerContent = 'Bạn chưa có tài khoản. <a href="/user/register">Đăng ký</a>';

        if (!$form->isValid($_POST)) {
            return;
        }
        $adapter = new Zend_Auth_Adapter_DbTable();
        $adapter
            ->setTableName('user')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setCredentialTreatment('md5(?)');
        $adapter->setIdentity($form->getValue('username'));
        $adapter->setCredential($form->getValue('password'));
        $auth   = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        // echo ($result->getCode());
        if ($result->isValid()) {
            $storage = $auth->getStorage()->write($adapter->getResultRowObject());
            $this->_redirect('/profile/list');
        }
    }
    public function registerAction()
    {
        $form = new Application_Form_RegisterForm;
        $model = new Application_Model_UserModel;
        $this->view->registerForm = $form;
        $this->view->headTitle = 'Đăng ký';
        $this->view->titlePage = 'Đăng ký';
        $this->view->headerContent = 'Bạn đã có tài khoản. <a href="/user/login">Đăng nhập</a>';

        if (!$form->isValid($_POST)) {
            return;
        }
        $username = $form->getValue('username');
        $password = md5($form->getValue('password'));
        $role = (int) $form->getValue('role');

        $model->addUser($username, $password, $role);
        return $this->redirect('/user/login');
    }

    public function logoutAction()
    {
        $auth   = Zend_Auth::getInstance();
        $auth->clearIdentity();
        // Zend_Session::destroy(true);
        return $this->redirect('/user/login');
    }
}
