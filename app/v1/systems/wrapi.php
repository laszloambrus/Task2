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
    //The HTTP method (GET, POST, PUT, or DELETE)
    protected $method;

    //The model requested eg.:user
    protected $endpoint;

    //any Additional parameters
    protected $params;

    //origin

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

            $this->method = $_SERVER['REQUEST_METHOD'];

            //Get Origin for security reasons
            if(array_key_exists('HTTP_ORIGIN',$_SERVER)){
                $this->origin = $_SERVER['HTTP_ORIGIN'];
            }else{
                $this->origin = "undifined";
            }

            //Setting endpoint
            $this->endpoint = array_shift($request);

        }



    }

    function parseURL(){
        //Preparing request
        //Concrete class for endpoint
        $request['endpoint'] = $uri[0];
        //Method in concrete class
        $request['method'] = $uri[1];
        //Parameters
        $request['params'] = $uri[2];
    }
}