<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Pie Chart</title>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.1.3"></script>

    <style type="text/css">
        .slice text {
            font-size: 12pt;
            font-family: "Times New Roman";
        }
    </style>
</head>
<body>

<!-- the simple pie chart d3.js script credit goes to enjalot @ https://gist.github.com/enjalot/1203641 -->

<?php


include('../d3-php-class/D3-class.php');

$data = array(
    'chart_data'=>array(
        array(
            'label'=>'one',
            'value'=>20
        ),
        array(
            'label'=>'two',
            'value'=>50
        ),
        array(
            'label'=>'three',
            'value'=>30
        )
    ),
    'dimensions'=>array(
        'height'=>300,
        'width'=>300,
        'radius'=>100
    )
);

$chart = new D3('simple_pie_chart',$data);

echo $chart;

?>
