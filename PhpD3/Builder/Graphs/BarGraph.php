<?php namespace PhpD3\Builder;

/**
 * Class BarGraph
 * @package PhpD3\Builder
 */
class BarGraph extends Builder
{
    public $chart_complete;

    protected $data_file = '';
    protected $height = '';
    protected $width = '';
    protected $margin_right = '';
    protected $margin_left = '';
    protected $margin_top = '';
    protected $margin_bottom = '';
    protected $ticks = 10;
    protected $xAxisOrient = "bottom";
    protected $yAxisOrient = "left";
    protected $x_axis_label;
    protected $y_axis_label;
    protected $colors;
    protected $render_element;
    protected $file_type;
    protected $data;
    protected $render_element_id;

    function __construct($full_data_array=array())
    {

        parent::__construct();

        $this->data_file = $full_data_array['data_file'];
        $this->file_type = (isset($full_data_array['file_type'])) ? $full_data_array['file_type'] : 'tsv';

        $this->data = (isset($full_data_array['chart_data'])) ? $full_data_array['chart_data'] : $this->prepData->run($this->data_file,$this->file_type);

        $this->height= (isset($full_data_array['dimensions']['height'])) ? $full_data_array['dimensions']['height'] : 500;
        $this->width= (isset($full_data_array['dimensions']['width'])) ? $full_data_array['dimensions']['width'] : 960;
        $this->x_axis_label = $full_data_array['axis_data']['x_axis_label'];
        $this->y_axis_label = $full_data_array['axis_data']['y_axis_label'];
        $this->margin_top = (isset($full_data_array['margins']['top'])) ? $full_data_array['margins']['top'] : 20;
        $this->margin_bottom = (isset($full_data_array['margins']['bottom'])) ? $full_data_array['margins']['bottom'] : 30;
        $this->margin_left = (isset($full_data_array['margins']['left'])) ? $full_data_array['margins']['left'] : 40;
        $this->margin_right = (isset($full_data_array['margins']['right'])) ? $full_data_array['margins']['right'] : 20;

        $this->autosize = (isset($full_data_array['autosize'])) ? $full_data_array['autosize'] : false;

        $this->generateRenderElement($full_data_array);

        $this->generateColors($full_data_array);

        $this->chart_complete = $this->buildGraph();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }

    function buildGraph(){

        $dimensions ="
        // set the dimensions and margins of the graph
        var margin = {top: ".$this->margin_top.", right: ".$this->margin_right.", bottom: ".$this->margin_bottom.", left: ".$this->margin_left."},
        width = ".$this->width." - margin.left - margin.right,
        height = ".$this->height." - margin.top - margin.bottom;";

        $graph="
        
        var data = ".$this->data.";
        
        // set the ranges
        var x = d3.scaleBand().range([0, width]).padding(0.1);
        var y = d3.scaleLinear().range([height, 0]);
                  
        // append the svg object to the body of the page
        // append a 'group' element to 'svg'
        // moves the 'group' element to the top left margin
        var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
        .attr(\"width\", width + margin.left + margin.right)
        .attr(\"height\", height + margin.top + margin.bottom)
        .append(\"g\")
        .attr(\"transform\", 
              \"translate(\" + margin.left + \",\" + margin.top + \")\");      
        
        function type(d) {
            d.".$this->y_axis_label." = +d.".$this->y_axis_label.";
            return d;
        };
        
        // Scale the range of the data in the domains
        x.domain(data.map(function(d) { return d.".$this->x_axis_label."; }));
        y.domain([0, d3.max(data, function(d) { return d.".$this->y_axis_label."; })]);
        
        // append the rectangles for the bar chart
        svg.selectAll(\".bar\")
        .data(data)
        .enter().append(\"rect\")
        .attr(\"class\", \"bar\")
        .attr(\"x\", function(d) { return x(d.".$this->x_axis_label."); })
        .attr(\"width\", x.bandwidth())
        .attr(\"y\", function(d) { return y(d.".$this->y_axis_label."); })
        .attr(\"height\", function(d) { return height - y(d.".$this->y_axis_label."); });
        
        // add the x Axis
        svg.append(\"g\")
        .attr(\"transform\", \"translate(0,\" + height + \")\")
        .call(d3.axisBottom(x))
        .selectAll(\"text\")
        .style(\"text-anchor\", \"end\")
        .attr(\"dx\", \"-.8em\")
        .attr(\"dy\", \".15em\")
        .attr(\"transform\", \"rotate(-65)\");
        
        // add the y Axis
        svg.append(\"g\").call(d3.axisLeft(y));
        ";

        $return = $dimensions.$graph;

        if($this->autosize){
            $margins = [
                'margin_top' => $this->margin_top,
                'margin_left' => $this->margin_left,
                'margin_right' => $this->margin_right,
                'margin_bottom' => $this->margin_bottom
            ];

            $return = $this->resize($this->render_element_id,$graph,$margins);
        }

        return $return;
    }
}