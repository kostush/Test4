<?php
class Dispatcher  {

    private $request;
    public function start(){
        $this->request = new Request;
        Router::parse($this->request);
        //var_dump($this->request);

        $controller =  $this->loadController();
       // var_dump($controller,$this->request->action);
        if (method_exists($controller, $this->request->action)){
           // echo "OK -  find method";//
            call_user_func([$controller,$this->request->action],$this->request->params);

        }
        else{
          echo  "error нет такого метода в классе или класса";
        }
    }

    public function loadController(){
        $controller_name = $this->request->controller.'Controller';
        $controller_file = ROOT.'Controllers/' . $controller_name . '.php';
       // var_dump($controller_name,$controller_file);

        if(file_exists($controller_file)){
            require($controller_file);
            $controller = new $controller_name();
          //  var_dump($controller);
            return $controller;
        }else{
            echo "Error - dont find controller";//error PAGE file no exist

        }
    }
}