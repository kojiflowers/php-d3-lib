<?php namespace PhpD3;

use PhpD3\Builder\AdvancedSunburstChart;
use PhpD3\Builder\DualScaleBarGraph;
use PhpD3\Builder\LineGraph;
use PhpD3\Builder\PieChart;
use PhpD3\Builder\BarGraph;
use PhpD3\Builder\SunburstChart;

// ref: https://github.com/d3/d3/wiki/Gallery

class Draw{

    private $data;
    public $chart;

    function __construct($type, $chart_data=array())
    {
        $this->data = $chart_data;
        if($type){
            switch($type){

            case 'simple_pie_chart';
                
                $built_chart = $this->simplePieChart();

                $this->chart = $this->load($built_chart);
                
                break;

            case 'simple_bar_graph';

                $built_chart = $this->simpleBarGraph();

                $this->chart = $this->load($built_chart);

                break;

            case 'dual_scale_bar_graph';

                $built_chart = $this->dualScaleBarGraph();

                $this->chart = $this->load($built_chart);

                break;

            case 'simple_line_graph';

                $built_chart = $this->simpleLineGraph();

                $this->chart = $this->load($built_chart);

                break;

            case 'sunburst_chart';

                $built_chart = $this->sunburstChart();

                $this->chart = $this->load($built_chart);

                break;

            case 'advanced_sunburst_chart';

                $built_chart = $this->advancedSunburstChart();

                $this->chart = $this->load($built_chart);

                break;
            }
        }

    }

    public function __toString()
    {
        return $this->chart;
    }

    /**
     * Render the finished chart
     * @return string
     */
    public function render(){
        return $this->chart;
    }


    /**
     * Add the "<script>" wrapper
     * @param string $built_chart
     * @return string
     */
    function load($built_chart=''){
        $load='<script type="text/javascript">';
        $load.=$built_chart;
        $load.='</script>';

        return $load;
    }
    
    /**
     * create simple pie chart
     *
     * @return PieChart
     */
    private function simplePieChart(){

        $render = new PieChart($this->data);
        
        return $render;
    }

    /**
     * Create a simple Bar Graph
     * https://bl.ocks.org/mbostock/3885304
     * 
     * @return BarGraph
     */
    private function simpleBarGraph(){

        $render = new BarGraph($this->data);

        return $render;
    }

    /**
     * Create a Dual Scale Bar Graph
     * https://bl.ocks.org/mbostock/3885304
     *
     * @return DualScaleBarGraph
     */
    private function dualScaleBarGraph(){

        $render = new DualScaleBarGraph($this->data);

        return $render;
    }

    /**
     * Create a simple Line Graph
     * https://bl.ocks.org/mbostock/3885304
     *
     * @return LineGraph
     */
    private function simpleLineGraph(){

        $render = new LineGraph($this->data);

        return $render;
    }

    /**
     * @return SunburstChart
     */
    private function sunburstChart(){

        $render = new SunburstChart($this->data);

        return $render;
    }

    /**
     * @return AdvancedSunburstChart
     */
    private function advancedSunburstChart(){

        $render = new AdvancedSunburstChart($this->data);

        return $render;
    }
}