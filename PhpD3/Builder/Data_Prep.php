<?php namespace PhpD3\Builder;

class Data_Prep extends Builder
{
    protected $type;
    protected $data;

    function __construct($type='tsv',$data)
    {

        $this->data = $data;

        switch($type) {

            case 'tsv';

                $this->prepTsv();

            break;

            case 'csv';

            break;

            case 'array';

            break;
        }

    }

    function prepTsv()
    {
        $this->data;

    }

    function prepCsv(){

        $this->data;

    }

}