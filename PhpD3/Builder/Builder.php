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
    protected $data_file;
    protected $file_type;

    public function __construct()
    {
        $this->prepData = new DataPrep();

    }

    /**
     * Universal resize capability for graph or chart
     * @param $render_element_id
     * @param $chart
     * @param bool $margins
     * @return string
     */
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

    /**
     * Generate the color array values
     * @param $full_data_array
     * @param string $type
     */
    public function generateColors($full_data_array,$type="array"){

        if(isset($full_data_array['colors'])){
            $this->colors = json_encode($full_data_array['colors']);
        }else{
            $this->colors = '["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]';
        }
    }

    /**
     * Generate the render_element and render_element_id values
     * @param $full_data_array
     */
    public function generateRenderElement($full_data_array){
        if(isset($full_data_array['render_element']['value'])){

            $type = '#';

            if($full_data_array['render_element']['type'] == 'class'){
                $type = '.';
            }

            $this->render_element = $type.$full_data_array['render_element']['value'];
            $this->render_element_id = $full_data_array['render_element']['value'];
        }
    }
}