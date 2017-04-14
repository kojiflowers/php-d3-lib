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

        return "var y = d3.scale.linear()
            .range([height, 0]);";

    }

    function setVarXAxis($scale="x",$orientation="bottom"){

        return "var xAxis = d3.svg.axis()
            .scale(".$scale.")
            .orient(\"".$orientation."\");";

    }

    function setVarYAxis($scale='y',$orienation="left",$ticks=10,$tickSymbol="%"){
        return "var yAxis = d3.svg.axis()
            .scale(".$scale.")
            .orient(\"".$orienation."\")
            .ticks(".$ticks.", \"".$tickSymbol."\");";
    }

    function setVarSvg($render_element){

        return " var svg = d3.select(\"".$render_element."\").append(\"svg\")
            .attr(\"width\", width + margin.left + margin.right)
            .attr(\"height\", height + margin.top + margin.bottom)
            .append(\"g\")
            .attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");";

    }



}