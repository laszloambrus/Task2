<?php
namespace v1\controllers;
class userController{
    function __construct($method){
        new \v1\models\user($method);
    }
}