<?php
class Request {
    public $url;
    public $method;
    public $Get;
    public $Post;
    public $controller;
    public $action;
    public $params;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->Get = $_GET;
        $this->Post= $_POST;

    }

}