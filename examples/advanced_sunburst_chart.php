<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Advanced Sunburst Chart</title>
    <script type="text/javascript" src="js/d3.v4.min.js"></script>

    <style>

        #main {
            float: left;
            width: 750px;
        }

        #sidebar {
            float: right;
            width: 100px;
        }

        #sequence {
            width: 600px;
            height: 70px;
        }

        #legend {
            padding: 10px 0 0 3px;
        }

        #sequence text, #legend text {
            font-weight: 600;
            fill: #fff;
        }

        #chart {
            position: relative;
        }

        #chart path {
            stroke: #fff;
        }

        #explanation {
            position: absolute;
            top: 200px;
            left: 305px;
            width: 140px;
            text-align: center;
            color: #666;
            z-index: -1;
        }

        #percentage {
            font-size: 2.5em;
        }

        .chart_container{
            float:none;
            height:750px;
            clear:right;
            width:900px;
        }

    </style>
</head>
<body>
<?php include_once('menu.php'); ?>

<!-- This Sunburst Chart script credit goes to Eduard Trott @ https://bl.ocks.org/maybelinot/5552606564ef37b5de7e47ed2b7dc099 -->

<h2>Welcome to the Advanced Sunburst Chart Example</h2>
<p>In this example we will be exploring the Advanced Sunburst Chart using the php-d3-lib.</p>

<h3>Advanced Sunburst Chart 1</h3>
<div class="chart_container">
    <div id="main">
        <div id="sequence"></div>
        <div id="chart">
            <div id="explanation" style="visibility: hidden;">
                <span id="percentage"></span><br/>
                of visits begin with this sequence of pages
            </div>
        </div>
    </div>
    <div id="sidebar">
        <input type="checkbox" id="togglelegend"> Legend<br/>
        <div id="legend" style="visibility: hidden;"></div>
    </div>
</div>
<br />

<h4>Sunburst Chart 1 PHP Code</h4>
<p>*renders chart into element with id="chart"</p>
<pre>
// if not already included, include the autoloader
include('../PhpD3/autoloader.php');

$data = array(
    'data_file'=>'visit-sequences.json',
    'dimensions'=>array(
        'height'=>500,
        'width'=>750
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'file_type'=>'json',
    'autosize'=>false
);

$chart = new PhpD3\Draw('advanced_sunburst_chart',$data);
$chart_render = $chart->render();

echo $chart_render;
</pre>

<br />
<hr />

<?php


include('../PhpD3/autoloader.php');

$data = array(
    'data_file'=>'visit-sequences.json',
    'dimensions'=>array(
        'height'=>500,
        'width'=>750
    ),
    'colors' => array(
      "home"=>"#5687d1",
        "product"=>"#7b615c",
        "search"=>"#de783b",
        "account"=>"#6ab975",
        "other"=>"#a173d1",
        "end"=>"#bbbbbb"
    ),
    'render_element'=>array(
        'value'=>'chart',
        'type'=>'id'
    ),
    'file_type'=>'json',
    'autosize'=>false
);

$chart = new PhpD3\Draw('advanced_sunburst_chart',$data);
$chart_render = $chart->render();

echo $chart_render;

?>
