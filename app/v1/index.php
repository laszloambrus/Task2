<?php

    //Path to ROOT folder on Server
    define('__SERVER_ROOT__',dirname(__FILE__));

    //URL to API site ROOT
    define('__SITE_ROOT__','/Task2/app/v1/');

    //Symphony classLoader

    //Fetching the URL
    $uri = $_SERVER['REQUEST_URI'];

    //Removing Path
    $uri = str_replace(__SITE_ROOT__,'',$uri);

    //Exploding URL
    $uri = explode('/',rtrim($uri,'/'));

    //Preparing request
    //Concrete class for endpoint
    $request['endpoint'] = $uri[0];
    //Method in concrete class
    $request['method'] = $uri[1];
    //Parameters
    $request['params'] = $uri[2];

    //get Origin for security reasons
    $origin = $_SERVER['HTTP_ORIGIN'];
    echo $origin;

    //Instantiate the API
    try{
       new api($request,$origin);
    }catch(Exception $e){
       echo $e->getMessage();
    }
