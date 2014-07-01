<?PHP
namespace v1\systems;
class api extends wrapi{
    function __construct($request){
        //Calling parent's Constructor
        parent::__construct($request);
    }

    function checkEndpoint(){
        if(file_exists('v1/controllers/'.$this->endpoint.'.php')){
            $class = 'v1\controllers\\'.$this->endpoint;
            new $class;
        }else{
            echo "Endpoint not found";
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