<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Testing Sunburst Chart</title>
        <script type="text/javascript" src="js/d3.v4.min.js"></script>

        <style>
            path {
                stroke: #fff;
            }
        </style>
    </head>
    <body>
        <?php include_once('menu.php'); ?>

        <!-- This Sunburst Chart script credit goes to Eduard Trott @ https://bl.ocks.org/maybelinot/5552606564ef37b5de7e47ed2b7dc099 -->

        <h2>Welcome to the Sunburst Chart Example</h2>
        <p>In this example we will be exploring the Sunburst Chart using the php-d3-lib.</p>

        <h3>Sunburst Chart 1 (Autosized)</h3>
        <div id="chart">
        </div>

        <h4>Sunburst Chart 1 PHP Code</h4>
        <p>*renders chart into element with id="chart"</p>
        <pre>
        // if not already included, include the autoloader
        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'flare.json',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'chart',
                'type'=>'id'
            ),
            'file_type'=>'json',
            'autosize'=>true
        );

        $chart = new PhpD3\Draw('sunburst_chart',$data);
        $chart_render = $chart->render();

        echo $chart_render;
        </pre>

        <br />
        <hr />

        <h3>Sunburst Chart 2</h3>
        <div id="chart_2">
        </div>

        <h4>Sunburst Chart 2 PHP Code</h4>
        <p>*renders chart into element with id="chart_2"</p>
        <pre>
        // if not already included, include the autoloader
        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'flare.json',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'chart_2',
                'type'=>'id'
            ),
            'file_type'=>'json',
        );

        $chart = new PhpD3\Draw('sunburst_chart',$data);
        $chart_render = $chart->render();

        echo $chart_render;
        </pre>

        <?php


        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'flare.json',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'chart',
                'type'=>'id'
            ),
            'file_type'=>'json',
            'autosize'=>true
        );

        $chart = new PhpD3\Draw('sunburst_chart',$data);
        $chart_render = $chart->render();


        echo $chart_render;

        $data = array(
            'data_file'=>'flare.json',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'chart_2',
                'type'=>'id'
            ),
            'file_type'=>'json',
        );

        $chart = new PhpD3\Draw('sunburst_chart',$data);
        $chart_render = $chart->render();


        echo $chart_render;

        ?>
        </body>
</html>
