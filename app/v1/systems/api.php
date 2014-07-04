<?PHP
namespace v1\systems;
class api extends wrapi{

    function __construct($request){
        //Calling parent's Constructor
        parent::__construct($request);

        //Check if controller exists
        if($this->checkEndpoint()){
            $class = 'v1\controllers\\'.$this->controller;
            //Instantiate the controller
            $controller = new $class($this->method,$this->filter);
        }else{
            echo 'controller not found';
        }
    }

    public function checkEndpoint(){
        if(is_readable('v1/controllers/'.$this->controller.'.php')){
            return 1;
        }else{
            return FALSE;
        }
    }

    //Getter function for Request Method
    function getMethod(){
        return $this->method;
    }

    //Getter function for Endpoint
    function getEndpoint(){
        return $this->endpoint;
    }

    //Getter function for Origin
    function getOrigin(){
        return $this->origin;
    }
}