<?php

class UserModel {

    public function getUser($login, $password) {
        $query = 'SELECT * FROM admins WHERE login=:login AND password=:password';
        $result = DatabaseHandler::GetRow($query, ['login'=>$login, 'password'=>$password]);
        if($result !== false) {
            return $result;
        } else {
            return;
        }
    }
}

class UserProfile {
    private $login;
    private $password;
    
    public function __construct($user) {
        foreach($user as $key=>$value) {
            $this->$key = $value;
        }
    }
}

class Auth {
    private $login;
    private $password;
    private $user;     
    
    public function init($login, $password) {
        $this->login = $login;
        $this->password = $this->hashPsw($password);
    }
    
    public function hashPsw ($password) {
        return md5($password);
    }
    
    public function verification() {
        $mdl = new UserModel();
        $result = $mdl->getUser($this->login, $this->password);
        if(count($result) !== 0) {
            $this->user = new UserProfile($result);
            $session = App::getApp()->getRequest()->getSession();
            $session->set('auth', true);
            $session->set('profile', $this->user);
            $session->set('login', $result['login']);
            return true;
        } else {
            return false;
        }
    }
    
    public function logout() {
        $session = App::getApp()->getRequest()->getSession();
        $session->clear('auth');
        $session->clear('profile');
        $session->clear('login');
    }
    
    public function isAuth() {
        $session = App::getApp()->getRequest()->getSession();
        return $session->get('auth');
    }
    
    public function getProfile() {
        $session = App::getApp()->getRequest()->getSession();
        return $session->get('profile');
    }
}
