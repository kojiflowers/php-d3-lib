<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Bar Chart</title>
    <script type="text/javascript" src="js/d3.v3.min.js"></script>

    <style type="text/css">
        .bar {
            fill: steelblue;
        }

        .bar:hover {
            fill: brown;
        }

        .axis {
            font: 10px sans-serif;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }

        .x.axis path {
            display: none;
        }

    </style>
</head>
<body>

<!-- this simple bar chart script credit goes to Mike Bostock @ https://bl.ocks.org/mbostock/3885304 -->

<h2>Welcome to the Simple Bar Chart Example</h2>
<p>In this example we will be exploring the Simple Bar Chart using the php-d3-lib.</p>

<h4>To begin be sure to include the library</h4>
<pre>
    include('../php-d3/autoloader.php');
</pre>

<h3>Bar Chart 1</h3>
<div id="chart"></div>

<h4>Bar Chart 1 PHP Code</h4>
<pre>

$data = array(
    'data_file'=>'chart_data.tsv',
    'dimensions'=>array(
        'height'=>500,
        'width'=>960
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'axis_data'=>array(
        'x_axis_label'=>'letter',
        'y_axis_label'=>'frequency',
    ),
    'file_type'=>'tsv',
);

$chart = new PhpD3\Chart('simple_bar_chart',$data);
$chart_render = $chart->render();


echo $chart_render;

</pre>

<?php


include('../php-d3/autoloader.php');

$data = array(
    'data_file'=>'chart_data.tsv',
    'dimensions'=>array(
        'height'=>500,
        'width'=>960
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'axis_data'=>array(
        'x_axis_label'=>'letter',
        'y_axis_label'=>'frequency',
    ),
    'file_type'=>'tsv',
);

$chart = new PhpD3\Chart('simple_bar_chart',$data);
$chart_render = $chart->render();


echo $chart_render;

?>
