<?php

class Request
{
    private $input;
    private $server;
    private $session;
    private $auth;

    public function __construct()
    {
        $this->input = new Input();
        $this->server = new Server();
        $this->session = new Session();
        $this->auth = new Auth();
    }

    public function getSession()
    {
        return $this->session;
    }
    
    public function getAuth()
    {
        return $this->auth;
    }

    public function getInput()
    {
        return $this->input;
    }
}
