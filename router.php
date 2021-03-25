<?php
/**
 * Created by PhpStorm.
 * User: kostush
 * Date: 18.03.2021
 * Time: 13:20
 */
class Router{
    static public function parse($request){
        /*$controller_name = 'Api';
        $action_name = 'index';*/

        $url = trim($request->url);
        if ($url =='/Test4/'){
            $request->controller = 'api';
            $request->action = 'index';
            $request->params = [];
        }
        else{

            $routes= explode('/',$url);
           // echo $routes;
            $routes = array_slice($routes,2);

            if(!empty($routes[0])){
                $request->controller  = $routes[0];
            }
            if(!empty($routes[1])){
                $routes_action = explode('?',$routes[1]);
                $request->action =$routes_action[0] ;
            }
            if (!empty($routes_action[1])){
                $request->params = $routes_action[1];
            }

        }
    }
}