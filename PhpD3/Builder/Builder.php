<?php namespace PhpD3\Builder;

class Builder
{
    protected $prepData;
    protected $autosize = false;
    protected $render_element_id;
    protected $data;
    protected $colors;
    protected $render_element;
    protected $data_array = array();
    protected $height = '';
    protected $width = '';

    public function __construct()
    {
        $this->prepData = new DataPrep();

    }

    public function resize($render_element_id,$chart,$margins=false){

            $margin_top = (isset($margins['margin_top'])) ? $margins['margin_top'] : 0;
            $margin_bottom = (isset($margins['margin_bottom'])) ? $margins['margin_bottom'] : 0;
            $margin_right = (isset($margins['margin_right'])) ? $margins['margin_right'] : 0;
            $margin_left = (isset($margins['margin_left'])) ? $margins['margin_left'] : 0;

        $return = "function redraw(){
                var chartDiv = document.getElementById(\"".$render_element_id."\");
                
                chartDiv.innerHTML = \"\";
                
                var margin = {top: ".$margin_top.", right: ".$margin_right.", bottom: ".$margin_bottom.", left: ".$margin_left."};
                var width = chartDiv.clientWidth - margin.left - margin.right;
                var height = (width/2) - margin.top - margin.bottom;
                
                ".$chart."
                
                };
            redraw();
            // Redraw based on the new size whenever the browser window is resized.
            window.addEventListener(\"resize\", redraw);
                ";

        return $return;
    }
}