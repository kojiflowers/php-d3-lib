<?php namespace D3;

use D3\Builder\D3_Pie_Chart;
use D3\Builder\D3_Bar_Chart;

// ref: https://github.com/d3/d3/wiki/Gallery

class D3{

    private $data;
    public $chart;

    function __construct($type='', $chart_data=array())
    {

        $this->data = $chart_data;

        switch($type){

            case 'simple_pie_chart';
                
                $built_chart = $this->simple_pie_chart();

                $this->chart = $this->load($built_chart);
                
                break;

            case 'simple_bar_chart';

                $built_chart = $this->simple_bar_chart();

                $this->chart = $this->load($built_chart);

                break;

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
    
    
    function simple_pie_chart(){

        $pie_chart = new D3_Pie_Chart($this->data);
        
        return $pie_chart;

    }

    // https://bl.ocks.org/mbostock/3885304
    function simple_bar_chart(){

        $bar_chart = new D3_Bar_Chart($this->data);

        return $bar_chart;

    }

    // http://bl.ocks.org/mbostock/5944371
    function bi_level_partition(){

    }


}