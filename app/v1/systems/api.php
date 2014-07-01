<?PHP
namespace v1\systems;
class api extends wrapi{
    function __construct($request){
        //Calling parent's Constructor
        parent::__construct($request);
    }

    //Getter function for Request Method
    function getMethod(){
        return $this->method;
    }

    //Getter function for Endpoint
    function getEndpoint(){
        return $this->endpoint;
    }


}