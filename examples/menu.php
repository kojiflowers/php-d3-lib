<?php

$base_url = sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
).'/examples/';

?>
<div class="menu">
    <h3>Examples Menu</h3>
</div>
<ul>
    <li><a href="<?php echo $base_url; ?>simple_bar_graph.php">Simple Bar Graph Example</a></li>
    <li><a href="<?php echo $base_url; ?>simple_line_graph.php">Simple Line Graph Example</a></li>
    <li><a href="<?php echo $base_url; ?>simple_pie_chart.php">Simple Pie Chart Example</a></li>
    <li><a href="<?php echo $base_url; ?>dual_scale_bar_graph.php">Dual Scale Bar Graph Example</a></li>
    <li><a href="<?php echo $base_url; ?>sunburst_chart.php">SunBurst Chart Example</a></li>
    <li><a href="<?php echo $base_url; ?>advanced_sunburst_chart.php">Advanced SunBurst Chart Example</a></li>
    <li><a href="<?php echo $base_url; ?>export_chart_as_png.php">Export Chart As PNG Example</a></li>
</ul>
