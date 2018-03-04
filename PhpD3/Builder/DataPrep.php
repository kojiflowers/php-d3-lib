<?php namespace PhpD3\Builder;

class DataPrep
{
    protected $type;
    protected $data;

    function __construct()
    {

    }

    public function run($data_file,$file_type = false){

        switch($file_type){
            case 'tsv':
                return $this->prepTsv($data_file);
            break;

            case 'csv':
                return $this->prepCsv($data_file);
            break;

            case 'json';
                return $this->prepJson($data_file);
            break;

            default;
                return $this->prepArray($data_file);
            break;
        }

    }

    public function prepTsv($data_file)
    {
        $handle = fopen($data_file,'r');
        $data_array = [];
        $header_array = [];
        if($handle !== FALSE){
            $i=0;
            $header = true;
            while (($data = fgetcsv($handle, 0, "\t")) !== FALSE){
                if($header){
                    $header_array = $data;
                    $header = false;
                }else{
                    foreach($header_array as $key => $value){
                        if(isset($data[$key])){
                            $data_array[$i][$value] = $data[$key];
                        }

                    }
                    $i++;
                }


            }
        }
        fclose($handle);

        return json_encode($data_array);

    }

    public function prepCsv($data_file){

        $handle = fopen($data_file,'r');
        $data_array = [];
        $header_array = [];
        if($handle !== FALSE){
            $i=0;
            $header = true;
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE){
                if($header){
                    $header_array = $data;
                    $header = false;
                }else{
                    foreach($header_array as $key => $value){
                        $data_array[$i][$value] = $data[$key];
                    }
                    $i++;
                }


            }
        }
        fclose($handle);

        return json_encode($data_array);

    }

    public function prepArray($array){
        return json_encode($array);
    }

    public function prepJson($data_file){

        $json = file_get_contents($data_file);

        return $json;

    }

    public function findDataRanges($data){

        $reorg = [];
        $ranges = [];
        $data = json_decode($data,true);

        foreach($data as $key => $value){
            foreach($value as $subkey => $subvalue){
                $reorg[$subkey][] = $subvalue;
            }

        }

        foreach($reorg as $key => $value){

            asort($value);
            $low = reset($value);
            $high = end($value);

            $ranges[$key] = array('low' => (int)$low, 'high' => (int)$high);
        }

        return $ranges;

    }

}