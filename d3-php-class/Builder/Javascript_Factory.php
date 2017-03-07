<?php namespace D3\Builder;


class Javascript_Factory extends Builder
{
    function __construct()
    {

    }

    function Range(){

    }

    function Select($select = 'svg')
    {
        return 'd3.select("'.$select.'")';
    }

    function setDimensions($margin_top=20,$margin_right=20,$margin_bottom=20,$margin_left=20,$width=960, $height=500)
    {

        return "
        var margin = {top: ".$margin_top.", right: ".$margin_right.", bottom: ".$margin_bottom.", left: ".$margin_left."},
        width = ".$width." - margin.left - margin.right,
        height = ".$height." - margin.top - margin.bottom;";

    }

    function setVarX()
    {
        return "var x = d3.scale.ordinal()
            .rangeRoundBands([0, width], .1);";
    }

    function setVarY()
    {

    }



}