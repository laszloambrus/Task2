<?php
    //Path to ROOT folder on Server
    define('__SERVER_ROOT__',dirname(__FILE__));

    //URL to API site ROOT
    define('__SITE_ROOT__','/Task2/app/');

    //Symfony classLoader
    require_once __DIR__.'/vendors/Symfony/Component/ClassLoader/UniversalClassLoader.php';

    //Aliasing the Loader
    use Symfony\Component\ClassLoader\UniversalClassLoader;

    //Instantiate the Loader
    $loader = new UniversalClassLoader();

    //Registering nameSpaces
    $loader->registerNamespaces(array(
        'v1\systems' => __DIR__ ,
        'v1\controllers' => __DIR__));

    //Registering the classloader
    $loader->register();

    //Fetching the URL
    $uri = $_SERVER['REQUEST_URI'];

    //Removing Path from the URL
    $uri = str_replace(__SITE_ROOT__,'',$uri);

    //Exploding URL
    $request = explode('/',rtrim($uri,'/'));


    //Aliasing the namespaces
    use v1\systems\api;
    use v1\controllers\user;

    try{
        //Instantiate the API - testing
        $api = new api($request);

        $api->getMethod();
        $api->getEndpoint();

        //Instantiate user class - testing
        $user = new user();
    }catch(Exception $e){
       echo $e->getMessage();
    }