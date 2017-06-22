<?php namespace PhpD3\Builder;

/**
 * Created by PhpStorm.
 * User: kojiflowers
 * Date: 2/22/17
 * Time: 7:10 AM
 */
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