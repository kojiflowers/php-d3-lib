<?php namespace D3\Builder;


class Javascript_Factory extends Builder
{
    function __construct()
    {

    }

    function d3_range(){

    }

    function d3_select($select = 'svg'){
        return 'd3.select("'.$select.'")';
    }

}