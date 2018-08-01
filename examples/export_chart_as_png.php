<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Testing Dual Scale Bar Graph</title>
        <script type="text/javascript" src="js/d3.v4.min.js"></script>
        <script type="text/javascript" src="js/saveSvgAsPng.js"></script>

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

            #showUri {
                word-wrap: break-word;
            }


        </style>
    </head>
    <body>
        <?php include_once('menu.php'); ?>

        <!-- this Dual Scale Bar Graph script credit goes to Fei Liu @ https://github.com/liufly/Dual-scale-D3-Bar-graph/tree/master/src -->

        <h2>Welcome to the Export Chart As PNG Example</h2>
        <p>In this example we will be exporting a chart generated using the php-d3-lib.</p>
        <p>This example uses saveSvgAsPng.js to perform the actual svg conversion. More info on saveSvgAsPng.js can be
            found on <a href="https://github.com/exupero/saveSvgAsPng">Github @ https://github.com/exupero/saveSvgAsPng</a></p>
        <h3>The Chart</h3>
        <div id="graph">
        </div>
        <div id="showUri">
        </div>
        <hr />
        <h3>Options</h3>
        <button onClick="saveImage();"><h3>Export as PNG</h3></button>
        <button onClick="showUri();"><h3>Show Image Uri</h3></button>
        <br />
        <small>*These buttons run one of the below js functions onClick</small>
        <hr />
        <h3>Javascript</h3>
        <pre>
            let showUri = function () {
                svgAsDataUri(d3.select('svg').node(), {}, function(uri) {
                    console.log('uri', uri);
                    document.getElementById(&quot;showUri&quot;).innerText = uri
                });
            };

            let saveImage = function () {
                saveSvgAsPng(d3.select('svg').node(), 'chart.png');
            };
        </pre>

        <?php


        include('../PhpD3/autoloader.php');

        $data = array(
            'data_file'=>'dual_scale_data.tsv',
            'dimensions'=>array(
                'height'=>400,
                'width'=>700
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
            'autosize'=>false
        );

        $graph = new PhpD3\Draw('dual_scale_bar_graph',$data);
        $graph_render = $graph->render();


        echo $graph_render;

        ?>

        <script type="text/javascript">

            let showUri = function () {
                svgAsDataUri(d3.select('svg').node(), {}, function(uri) {
                    console.log('uri', uri);
                    document.getElementById("showUri").innerText = uri
                });
            };

            let saveImage = function () {
                saveSvgAsPng(d3.select('svg').node(), 'chart.png');
            };


        </script>
    </body>
</html>
