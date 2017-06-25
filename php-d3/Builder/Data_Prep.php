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

                $this->prep_tsv();

            break;

            case 'csv';

            break;

            case 'array';

            break;
        }

    }

    function prep_tsv()
    {
        $this->data;

    }

    function prep_csv(){

        $this->data;

    }

}