<?php
class Controller{

    var $vars = [];
    var $layout = "default";

    protected function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        header("Content-Type: application/json");
        echo json_encode($data);
        return json_encode($data);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            201 => 'Created',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    function render($filename, $token=""){
        extract ($this->vars);
        echo "GET CLASS - ";
        echo get_Class($this);
        echo $this->layout;
        echo "  Token in render" ,$token;
        ob_start();

        require (ROOT."Views/".ucfirst(str_replace('Controller','',get_Class($this))).'/'.$filename.'.php');

        $content_for_layout = ob_get_clean();

        if ($this->layout == false){
            $content_for_layout=0;
        }else{
            echo "  Else";
            echo (ROOT.'Views/Layouts/'.$this->layout.'.php');
            require (ROOT.'Views/Layouts/'.$this->layout.'.php');
        }

    }




    private function secure_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form){
        foreach($form as $key => $value){
            $form[$key] = $this->secure_input($value);
        }
    }
    public function writelog($data,$title='debug'){
        $log = "\n------------------------\n";
        $log .= date("Y.m.d G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        file_put_contents(__DIR__ . '/log_'.date("Y.m.d").'.log', $log, FILE_APPEND);
        return true;

    }
}