<?PHP
namespace app\v1;
require_once 'wrapi.php';
class api extends wrapi{
    function __construct($request,$origin){
        //Calling parent's Constructor
        parent::__construct($request,$origin);
    }
}