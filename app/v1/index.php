<?php

    //Path to ROOT folder on Server
    define('__SERVER_ROOT__',dirname(__FILE__));

    //URL to API site ROOT
    define('__SITE_ROOT__','/Task2/app/v1/');

    //Symphony classLoader
    require_once __DIR__.'\vendors\Symfony\Component\ClassLoader\UniversalClassLoader.php';
    use Symfony\Component\ClassLoader\UniversalClassLoader;

    $loader = new UniversalClassLoader();
    $loader->registerNamespace('app\v1', __SERVER_ROOT__);

    echo __SERVER_ROOT__;
    $loader->register();

    echo '<PRE>';
    print_r($loader->getNamespaces());
    echo '</PRE>';

    require_once('api.php');

    //Fetching the URL
    $uri = $_SERVER['REQUEST_URI'];

    //Removing Path
    $uri = str_replace(__SITE_ROOT__,'',$uri);

    //Exploding URL
    $uri = explode('/',rtrim($uri,'/'));

    //Preparing request - I (think) i will move this part to my Abstract class
    //Concrete class for endpoint
    $request['endpoint'] = $uri[0];
    //Method in concrete class
    $request['method'] = $uri[1];
    //Parameters - filters etc..
    $request['params'] = $uri[2];

    //get Origin for security reasons
    $origin = $_SERVER['HTTP_ORIGIN'];
    //echo $origin;

    //What's included - Just for testing purposes
    echo '<PRE>';
    print_r(get_included_files());
    echo '</PRE>';

    try{
        new \app\v1\api($request,$origin);
    }catch(Exception $e){
        echo $e->getMessage();
    }