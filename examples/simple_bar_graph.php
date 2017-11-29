<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Bar Graph</title>
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
<?php include_once('menu.php'); ?>

<!-- this simple Bar Graph script credit goes to Mike Bostock @ https://bl.ocks.org/mbostock/3885304 -->

<h2>Welcome to the Simple Bar Graph Example</h2>
<p>In this example we will be exploring the Simple Bar Graph using the php-d3-lib.</p>


<h3>Bar Graph 1</h3>
<div id="chart"></div>

<h4>Bar Graph 1 PHP Code</h4>
<p>*renders chart into element with id="chart"</p>
<pre>
// if not included already, include the autoloader
include('../PhpD3/autoloader.php');
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

$chart = new PhpD3\Draw('simple_bar_graph',$data);
$chart_render = $chart->render();

echo $chart_render;
</pre>

<?php


include('../PhpD3/autoloader.php');

$data = array(
    'data_file'=>'bar_graph_data.tsv',
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

$chart = new PhpD3\Draw('simple_bar_graph',$data);
$chart_render = $chart->render();


echo $chart_render;

?>
