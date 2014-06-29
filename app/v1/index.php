<?php

    //Path to ROOT folder
    define('SERVER_ROOT','/wamp/www/Task2/');

    //URL to API site ROOT
    define('SITE_ROOT','localhost/Task2/');

    /*
     * Loader for Classes - at this time I stick to my own.
     * I might change it later for PSO standard
     */
    function classLoader($className){
        $class = $className.'.php';
        if(is_readable($class)){
            include($class);
        }
    }

    //Registering my new ClassLodaer
    spl_autoload_register(classLoader);

    //This will be the Main Controller
    require_once('api.php');

    new app\v1\api();

    //Fetching the URI
    $uri = $_SERVER['REQUEST_URI'];
    echo $uri;