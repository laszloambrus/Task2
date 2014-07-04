<?php
namespace v1\systems;
/*
 * Wrapper class for any concrete endpoints
 * 1. Fetches the URL
 * 2. Parses the URL and GETS the endpoint
 * 3. Detects the HTTP method used
 * 4. Assembles data to send it to the concrete class eg.: user
 * 5. Returns an HTTP response to Browser
 * */

abstract class wrapi{
    /*The HTTP method (GET, POST, PUT, or DELETE) -
    it comes from the query string method variable */
    protected $method;

    //The model requested eg.:user
    protected $endpoint;

    //any Additional parameters
    protected $params;

    //Name of controller
    protected $controller;

    //origin
    protected $origin;

    //This constructor will be called from child classes
    /*
     *  Parameters used: $request: is the url
     * */
    public function __construct($request=null){
        if($request){

            //Tell to browser that the content of this page is accessible to every domain
            header("Access-Control-Allow-Origin:*");

            //Tell the browser the type of Output
            header("Content-type: application/json; charset=utf-8");

            //Tell the browser about the used methods (POST, GET etc.)
            header("Access-Control-Allow-Methods:POST, GET, PUT, DELETE");

            /*
                This was the original idea, but because not every browser
                supports every method I'll use the query string instead
                passing methods as a variable after Query string
            */
            //$this->method = $_SERVER['REQUEST_METHOD'];

            //Get Origin for security reasons
            if(array_key_exists('HTTP_ORIGIN',$_SERVER)){
                $this->origin = $_SERVER['HTTP_ORIGIN'];
            }else{
                //in case the Origin is from the same SERVER
                $this->origin = $_SERVER['SERVER_NAME'];
            }

            //Setting endpoint - cutting off query string
            if($_SERVER['QUERY_STRING']){
                $this->endpoint =  strstr($request, '?', true);
            }else{
                $request = rtrim($request,'/');

                //If no Query String last item is the endpoint
                $request = explode('/',$request);

                //Removing The firt empty element
                $request = array_slice($request,1);

                //print_r($request);

                //Is there a second item in array?
                if(count($request)>1){
                    if(is_numeric($filter = $request[1])){
                        $this->filter = $filter;
                    }
                }

                //The first item is the endpoint
                $endpoint = array_shift($request);

                //$endpoint = end($request);
                $this->endpoint = $endpoint;
            }

            //Setting the name of  the concrete controller
            if($this->endpoint){
                $this->controller = $this->endpoint.'Controller';
            }

            //Getting params
            if($qs = $_SERVER['QUERY_STRING']){
                //Separating parameters (variable = value)
                $parameters = explode('&',$qs);

                foreach($parameters as $key => $pairs){
                    $p = explode('=',$pairs);
                    //Variable and Value
                    if($p[1]){
                        $param[$p[0]] = $p[1];
                    }
                }

                //Setting method
                if(is_array($param)){
                    if(array_key_exists('method',$param)){
                        $validMethods = array('POST','GET','PUT','DELETE');
                        if(in_array(strtoupper($param['method']),$validMethods)){
                            $this->method = $param['method'];
                        }else{
                            echo 'Not valid method: '.$param['method'];
                        }
                    }
                }
            }else{
                //No Query string
                if($this->endpoint){
                    $this->method = 'get';
                }
            }
        }
    }
}