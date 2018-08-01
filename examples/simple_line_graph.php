<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Testing Line Graph</title>
        <script type="text/javascript" src="js/d3.v4.min.js"></script>

        <style type="text/css">
            .line {
                fill: none;
                stroke: #ffab00;
                stroke-width: 3;
            }

            .axis{
                font: 10px sans-serif;
            }

            .axis-label{
                font: 12px sans-serif;
            }

            .circle {
                fill: steelblue;
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

            div.tooltip {
                position: absolute;
                text-align: center;
                width: 60px;
                height: 28px;
                padding: 2px;
                font: 12px sans-serif;
                background: lightsteelblue;
                border: 0px;
                border-radius: 8px;
                pointer-events: none;
            }

        </style>
    </head>
    <body>
        <?php include_once('menu.php'); ?>

        <!-- this simple Line Graph script credit goes to Mike Bostock @ https://bl.ocks.org/mbostock/3885304 -->

        <h2>Welcome to the Simple Line Graph Example</h2>
        <p>In this example we will be exploring the Simple Line Graph using the php-d3-lib.</p>


        <h3>Line Graph 1 (Autosized)</h3>
        <div id="graph"></div>

        <h4>Line Graph 1 PHP Code</h4>
        <p>*renders graph into element with id="graph"</p>
        <pre>
        // if not included already, include the autoloader
        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'graph_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
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
            'autosize' => true
        );

        $graph = new PhpD3\Draw('simple_line_graph',$data);
        $graph_render = $graph->render();
        </pre>

        <br />
        <hr />

        <h3>Line Graph 2</h3>
        <div id="graph_2"></div>

        <h4>Line Graph 2 PHP Code</h4>
        <p>*renders graph into element with id="graph_2"</p>
        <pre>
        // if not included already, include the autoloader
        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'graph_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
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

        $graph = new PhpD3\Draw('simple_line_graph',$data);
        $graph_render = $graph->render();
        </pre>

        <?php


        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'graph_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
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
            'autosize' => true
        );

        $graph = new PhpD3\Draw('simple_line_graph',$data);
        $graph_render = $graph->render();

        echo $graph_render;

        $data = array(
            'data_file'=>'graph_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
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

        $graph = new PhpD3\Draw('simple_line_graph',$data);
        $graph_render = $graph->render();


        echo $graph_render;

        ?>
    </body>
</html>
