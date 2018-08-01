<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Testing Dual Scale Bar Graph</title>
        <script type="text/javascript" src="js/d3.v4.min.js"></script>

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


        </style>
    </head>
    <body>
        <?php include_once('menu.php'); ?>

        <!-- this Dual Scale Bar Graph script credit goes to Fei Liu @ https://github.com/liufly/Dual-scale-D3-Bar-graph/tree/master/src -->

        <h2>Welcome to the Dual Scale Bar Graph Example</h2>
        <p>In this example we will be exploring the Dual Scale Bar Graph using the php-d3-lib.</p>

        <h3>Dual Scale Bar Graph 1 (Autosized)</h3>
        <div id="graph">
        </div>

        <h4>Dual Scale Bar Graph 1 PHP Code</h4>
        <p>*renders graph into element with id="graph"</p>
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
                'value'=>'graph',
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
            'autosize'=>true
        );

        $graph = new PhpD3\Draw('dual_scale_bar_graph',$data);
        $graph_render = $graph->render();

        echo $graph_render;
        </pre>

        <br />
        <hr />

        <h3>Dual Scale Bar Graph 2</h3>
        <div id="graph_2">
        </div>

        <h4>Dual Scale Bar Graph 2 PHP Code</h4>
        <p>*renders graph into element with id="graph_2"</p>
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
                'value'=>'graph_2',
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

        $graph = new PhpD3\Draw('dual_scale_bar_graph',$data);
        $graph_render = $graph->render();

        echo $graph_render;
        </pre>
        <br />
        <hr />
        <?php


        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'dual_scale_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'graph',
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
            'autosize'=>true
        );

        $graph = new PhpD3\Draw('dual_scale_bar_graph',$data);
        $graph_render = $graph->render();


        echo $graph_render;

        $data = array(
            'data_file'=>'dual_scale_data.tsv',
            'dimensions'=>array(
                'height'=>500,
                'width'=>950
            ),
            'render_element'=>array(
                'value'=>'graph_2',
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

        $graph = new PhpD3\Draw('dual_scale_bar_graph',$data);
        $graph_render = $graph->render();


        echo $graph_render;

        ?>
    </body>
</html>
