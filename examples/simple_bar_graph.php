<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Testing Bar Graph</title>
        <script type="text/javascript" src="js/d3.v4.min.js"></script>

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

        </style>
    </head>
    <body>
    <?php include_once('menu.php'); ?>

    <!-- this simple Bar Graph script credit goes to Mike Bostock @ https://bl.ocks.org/mbostock/3885304 -->

    <h2>Welcome to the Simple Bar Graph Example</h2>
    <p>In this example we will be exploring the Simple Bar Graph using the php-d3-lib.</p>


    <h3>Bar Graph 1 (Autosized)</h3>
    <div id="graph"></div>

    <h4>Bar Graph 1 PHP Code</h4>
    <p>*renders graph into element with id="graph"</p>
    <pre>
    // if not included already, include the autoloader
    include('../PhpD3/autoloader.php');

    $data = array(
        'data_file'=>'graph_data.tsv',
        'dimensions'=>array(
            'height'=>500,
            'width'=>960
        ),
        'render_element'=>array(
            'value'=>'graph',
            'type'=>'id'
        ),
        'axis_data'=>array(
            'x_axis_label'=>'letter',
            'y_axis_label'=>'frequency',
        ),
        'file_type'=>'tsv',
        'autosize'=>true
    );

    $chart = new PhpD3\Draw('simple_bar_graph',$data);
    $chart_render = $chart->render();
    </pre>
    <br />
    <hr />

    <h3>Bar Graph 2</h3>
    <div id="graph_2"></div>

    <h4>Bar Graph 2 PHP Code</h4>
    <p>*renders graph into element with id="graph_2"</p>
    <pre>
    // if not included already, include the autoloader
    include('../PhpD3/autoloader.php');

    $data = array(
        'data_file'=>'graph_data.tsv',
        'dimensions'=>array(
            'height'=>500,
            'width'=>960
        ),
        'render_element'=>array(
            'value'=>'graph_2',
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
    </pre>
    <br />
    <hr />

    <?php


    include('../PhpD3/autoloader.php');

    $data = array(
        'data_file'=>'graph_data.tsv',
        'dimensions'=>array(
            'height'=>500,
            'width'=>960
        ),
        'render_element'=>array(
            'value'=>'graph',
            'type'=>'id'
        ),
        'axis_data'=>array(
            'x_axis_label'=>'letter',
            'y_axis_label'=>'frequency',
        ),
        'file_type'=>'tsv',
        'autosize'=>true
    );

    $chart = new PhpD3\Draw('simple_bar_graph',$data);
    $chart_render = $chart->render();


    echo $chart_render;

    $data = array(
        'data_file'=>'graph_data.tsv',
        'dimensions'=>array(
            'height'=>500,
            'width'=>960
        ),
        'render_element'=>array(
            'value'=>'graph_2',
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
    </body>
</html>
