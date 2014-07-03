<?PHP
namespace v1\models;
class Model{
    //Data from concrete models
    protected $datas = array();

    public function __construct(){

    }

    //Get data and prepare it according to requested fileType
    protected function getData($fileType){
        switch ($fileType){
            case 'json':
                //Return data jason_encoded
                echo json_encode($this->datas);
                break;
            default:
                echo json_encode($this->datas);
                break;
        }
    }
}