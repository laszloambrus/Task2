<?PHP
namespace v1\models;
class User extends Model{

    function __construct($method,$filter){
        //Decide what to do according to method
        switch (strtolower($method)){
            case 'get':
                $this->readUserData($filter);
                $this->getData('json');
                break;
            default:
                echo 'Not supported method!';
                break;
        }
    }

    protected function readUserData($filter){
        //Path to user data
        $file = 'v1\data\user\users.csv';

        //Check if file exists and readable
        if(is_readable($file)){
            //Here i made some "spice up" on the code provided

            //Fopen gives back the handle!
            $handle = fopen($file,r);

            if (($handle = fopen("$file","r")) !== FALSE) {
                while(($line = fgetcsv($handle,1000,',')) !== FALSE){
                    //print_r($line);

                    //PHP Standard object
                    $data = new \stdClass();

                    //Storing every record in an Object
                    //I need id to get concrete user data!
                    $data->id = $line[0];
                    $data->name = $line[1];
                    $data->phone = $line[2];
                    $data->street = $line[3];

                    //Check whether data is filtered (eg.: user with an ID)
                    if($filter){
                        //Push data in the array using id as index
                        if($filter == $data->id){
                            $this->datas[$line[0]] = $data;
                        }
                    }else{
                        //If there is no filtering every data will be stored
                        $this->datas[$line[0]] = $data;
                    }
                }
                fclose($handle);
            }
        }else{
            //File not found or not readable
            echo 'File I/O problem';
        }
    }
}