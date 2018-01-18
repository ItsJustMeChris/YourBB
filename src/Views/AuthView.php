<?php
namespace YourBB\Views;

class AuthView
{
    private $model;
    private $controller;
    private $data = array();

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output(){
        $data = $this->model->data;
        require_once($this->model->template);
    }
}
