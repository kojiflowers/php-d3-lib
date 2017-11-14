<?php namespace PhpD3;

use PhpD3\Builder\D3_Pie_Chart;
use PhpD3\Builder\D3_Bar_Graph;

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
     * @return D3_Pie_Chart
     */
    private function simplePieChart(){

        $pie_chart = new D3_Pie_Chart($this->data);
        
        return $pie_chart;
    }

    /**
     * Create a simple bar chart
     * https://bl.ocks.org/mbostock/3885304
     * 
     * @return D3_Bar_Graph
     */
    private function simpleBarGraph(){

        $bar_chart = new D3_Bar_Graph($this->data);

        return $bar_chart;
    }

    // http://bl.ocks.org/mbostock/5944371
    private function bi_level_partition(){

    }


}