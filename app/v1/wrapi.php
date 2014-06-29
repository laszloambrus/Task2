<?php
namespace app\v1;
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

    //This constructor will be called from child classes
    /*
     *  Parameters used: $request: is the url
     * */
    public function __construct($request,$origin){
        /*Tell to browser that the content
        of this page is accessible to every domain
        */
        header("Access-Control-Allow-Origin:*");

        /*
         * Tell the browser the type of Output
        */
        header("Content-type: application/json; charset=utf-8");

        /*
         * Tell the browser about the used methods (POST, GET etc.)
        */
        header("Access-Control-Allow-Methods:POST, GET, PUT, DELETE");

    }
}