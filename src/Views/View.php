<?php
namespace YourBB\Views;

class View
{
    private $model;
    private $controller;
    private $data = array();

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output(){
        return $data = $this->model->data;
    }
}
