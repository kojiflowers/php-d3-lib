<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Dual Scale Bar Graph</title>
    <script type="text/javascript" src="js/d3.v3.min.js"></script>

    <style>

        .y.axisRight text {
            fill: orange;
        }

        .y.axisLeft text {
            fill: steelblue;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }

        .bar1 {
            fill: steelblue;
        }

        .bar2 {
            fill: orange;
        }

        .x.axis path {
            display: none;
        }

    </style>
</head>
<body>
<?php include_once('menu.php'); ?>

<!-- this Dual Scale Bar Graph script credit goes to Fei Liu @ https://github.com/liufly/Dual-scale-D3-Bar-Chart/tree/master/src -->

<h2>Welcome to the Dual Scale Bar Graph Example</h2>
<p>In this example we will be exploring the Dual Scale Bar Graph using the php-d3-lib.</p>

<h3>Dual Scale Bar Graph 1</h3>
<div id="chart">
</div>
<?php


include('../PhpD3/autoloader.php');

$data = array(
    'data_file'=>'dual_scale_data.tsv',
    'dimensions'=>array(
        'height'=>500,
        'width'=>950
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'axis_data'=>array(
        'xAxis' =>[
            'label' => 'Testing 1',
            'key' => 'testing1'
        ],
        'yAxis' =>[
            'label' => 'Testing 2',
            'key' => 'testing2'
        ],
        'y2Axis' =>[
            'label' => 'Num',
            'key' => 'num'
        ],
    ),
    'file_type'=>'tsv',
);

$chart = new PhpD3\Draw('dual_scale_bar_graph',$data);
$chart_render = $chart->render();


echo $chart_render;

?>

<h4>Dual Scale Bar Graph 1 PHP Code</h4>
<pre>
// if not already included, include the autoloader
include('../PhpD3/autoloader.php');

$data = array(
    'data_file'=>'dual_scale_data.tsv',
    'dimensions'=>array(
        'height'=>500,
        'width'=>950
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'axis_data'=>array(
        'xAxis' =>[
           'label' => 'Testing 1',
           'key' => 'testing1'
        ],
        'yAxis' =>[
            'label' => 'Testing 2',
            'key' => 'testing2'
        ],
        'y2Axis' =>[
            'label' => 'Num',
            'key' => 'num'
        ],
    ),
    'file_type'=>'tsv',
);

$chart = new PhpD3\Draw('dual_scale_bar_graph',$data);
$chart_render = $chart->render();


echo $chart_render;

</pre>
