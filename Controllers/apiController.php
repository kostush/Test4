<?php
class ApiController extends Controller {
        function index(){
            $this->render('index');
        }

        function auth(){
           if ((isset ($_POST['login'])) AND (isset($_POST['pass']))){
              //  echo" POST finded  ";
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $model_file = ROOT.'Models/Api.php';
               // echo " model file -",$model_file ,"\n";

                //var_dump(stream_resolve_include_path('Api.php'));
                if (file_exists($model_file)){
                  //  echo " file_exist ";
                    require ($model_file);
                  //  echo " AFTER REQUIRE ";
                    $model = new Api();
                    if($model->auth($login,$pass)){

                        //header("Location:".WEBROOT."tasks/index");
                        // header('HTTP/1.1 201 Created');
                        // header('Content/Type: application/json');
                        //$this->render('token',$model->token);
                        $this->response(array("token"=>$model->token),"201");
                    }else {
                        $this->response("Saving error", 500);
                    }
                }else{
                    $this->response("Model file FILE is NOT EXIST","500");
                }

           }else{
               $this->response("Login or Pass not set","500");
           }
        }

        function generate(){
           // Var_dump($_SERVER);
            echo "GENERATE",
            var_dump($_GET);

            $get = ($_GET);
            echo $get;
            //echo $get['Authorization'];
            echo "is_array - ",($get['Authorization']);
            if (isset($get['Authorization'])){
                $stroka = $get['Authorization'];
                echo " stroka-",$stroka;
                $token = (str_replace('Bearer',"",$stroka));

                if(file_exists(ROOT.'Models/Api.php')){

                    require (ROOT.'Models/Api.php');
                    $model = new Api();echo " in if ", $token;
                    if ($model ->check_auth($token)){
                        echo " после авторизации ";
                        if( $model->generate()){
                            echo " после generate ";
                            $this->response(array("id" => $model->transaction_id, "value"=>$model->random),"201");

                        }else{
                            $this->response("Generate error","401");
                        };

                    }else{
                        $this->response("Token is incorrect or expired","401");
                    };
                }else{
                    $this->response("Model file FILE is NOT EXIST","500");
                }


            }else{
                $this->response("Absent Authorization parameter","401");
            }

        }

        function retrieve($id){

            if (isset($_GET['Authorization'])){
                $token = trim(str_replace('Bearer',"",$_GET['Authorization']));
                if(file_exists(ROOT.'Models/Api.php')){
                    require (ROOT.'Models/Api.php');
                    $model = new Api();
                    if ($model ->check_auth($token)){
                        if (isset($_GET['id'])){
                            if($result  = $model->retrieve($_GET['id'])){
                                $this->response(array("value" => $result['RANDOM']),"200");
                            }else{
                                $this->response("transaction_id is absent","401");
                            };

                        }else{
                            $this->response("id is absent","401");
                        }
                    }else{
                        $this->response("Token is incorrect or expired","401");
                    };
                }else{
                    $this->response("Model file FILE is NOT EXIST","500");
                };
            }else{
                $this->response("Absent Authorization parameter","401");
            }

        }

}