<?php namespace PhpD3\Builder;

/**
 * Class BarGraph
 * @package PhpD3\Builder
 */
class DualScaleBarGraph extends Builder
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
    protected $yAxisLeftOrient = "left";
    protected $yAxisRightOrient = "right";
    protected $x_axis_label;
    protected $y_axis_label;
    protected $y_axis2_label;
    protected $x_axis_key;
    protected $y_axis_key;
    protected $y_axis2_key;
    protected $colors;
    protected $render_element;
    protected $file_type;
    protected $data;
    protected $series_num;
    protected $ranges;


    function __construct($full_data_array=array())
    {

        parent::__construct();

        $this->data_file = $full_data_array['data_file'];
        $this->file_type = (isset($full_data_array['file_type'])) ? $full_data_array['file_type'] : 'tsv';
        
        $this->data = (isset($full_data_array['chart_data'])) ? $full_data_array['chart_data'] : $this->prepData->run($this->data_file,$this->file_type);
        $this->ranges = $this->prepData->findDataRanges($this->data);

        $this->autosize = (isset($full_data_array['autosize'])) ? $full_data_array['autosize'] : false;

        $this->height= (isset($full_data_array['dimensions']['height'])) ? $full_data_array['dimensions']['height'] : 500;
        $this->width= (isset($full_data_array['dimensions']['width'])) ? $full_data_array['dimensions']['width'] : 960;
        $this->x_axis_label = $full_data_array['axis_data']['xAxis']['label'];
        $this->y_axis_label = $full_data_array['axis_data']['yAxis']['label'];
        $this->y_axis2_label = $full_data_array['axis_data']['y2Axis']['label'];
        $this->x_axis_key = $full_data_array['axis_data']['xAxis']['key'];
        $this->y_axis_key = $full_data_array['axis_data']['yAxis']['key'];
        $this->y_axis2_key = $full_data_array['axis_data']['y2Axis']['key'];
        $this->margin_top = (isset($full_data_array['margins']['top'])) ? $full_data_array['margins']['top'] : 40;
        $this->margin_bottom = (isset($full_data_array['margins']['bottom'])) ? $full_data_array['margins']['bottom'] : 40;
        $this->margin_left = (isset($full_data_array['margins']['left'])) ? $full_data_array['margins']['left'] : 70;
        $this->margin_right = (isset($full_data_array['margins']['right'])) ? $full_data_array['margins']['right'] : 40;


        $this->generateRenderElement($full_data_array);

        $this->generateColors($full_data_array);

        $this->chart_complete = $this->buildGraph();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }


    function buildGraph()
    {
        $low_y_axis = $this->ranges[$this->y_axis_key]['low']-200;
        $low_y2_axis = $this->ranges[$this->y_axis2_key]['low']-15;

        $high_y_axis = $this->ranges[$this->y_axis_key]['high']+100;
        $high_y2_axis = $this->ranges[$this->y_axis2_key]['high']+5;

        $dimensions = "
        var margin = {top: ".$this->margin_top.", right: ".$this->margin_right.", bottom: ".$this->margin_bottom.", left: ".$this->margin_left."},
        width = ".$this->width." - margin.left - margin.right,
        height = ".$this->height." - margin.top - margin.bottom;";

        $graph = "
        var x = d3.scaleBand().range([0, width]).paddingInner(0.25).paddingOuter(0.25);
    
        var y0 = d3.scaleLinear().domain([".$low_y_axis.",".$high_y_axis."]).range([height, 0]),
            y1 = d3.scaleLinear().domain([".$low_y2_axis.",".$high_y2_axis."]).range([height, 0]);
    
        var xAxis = d3.axisBottom(x);
            
        var data = ".$this->data."
    
        // create left yAxis
        var yAxisLeft = d3.axisLeft(y0);
        // create right yAxis
        var yAxisRight = d3.axisRight(y1);
        
        var max = d3.max(data, function(d) { return d.".$this->y_axis_key."; });
    
        var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
        .attr(\"width\", width + margin.left + margin.right)
        .attr(\"height\", height + margin.top + margin.bottom)
        .append(\"g\")
        .attr(\"class\", \"graph\")
        .attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");
    
        x.domain(data.map(function(d) { return d.".$this->x_axis_key."; }));
        y0.domain([0, max]);
    
        svg.append(\"g\")
        .attr(\"class\", \"x axis axis--x\")
        .attr(\"transform\", \"translate(0,\" + height + \")\")
        .call(xAxis)
        .selectAll(\"text\")
        .style(\"text-anchor\", \"end\")
        .attr(\"dx\", \"-.8em\")
        .attr(\"dy\", \".15em\")
        .attr(\"transform\", \"rotate(-65)\");
        
        svg.append(\"g\")
        .attr(\"class\", \"y axis axisLeft\")
        .attr(\"transform\", \"translate(0,0)\")
        .call(yAxisLeft)
        .append(\"text\")
        .attr(\"y\", 6)
        .attr(\"dy\", \"-2em\")
        .style(\"text-anchor\", \"end\")
        .text(\"".$this->y_axis_label."\");
        
        svg.append(\"g\")
        .attr(\"class\", \"y axis axisRight\")
        .attr(\"transform\", \"translate(\" + (width) + \",0)\")
        .call(yAxisRight)
        .append(\"text\")
        .attr(\"y\", 6)
        .attr(\"dy\", \"-2em\")
        .attr(\"dx\", \"2em\")
        .style(\"text-anchor\", \"end\")
        .text(\"".$this->y_axis2_label."\");

        bars = svg.selectAll(\".bar\").data(data).enter();

        bars.append(\"rect\")
            .attr(\"class\", \"bar1\")
            .attr(\"x\", function(d) { return x(d.".$this->x_axis_key."); })
            .attr(\"width\", x.bandwidth()/2)
            .attr(\"y\", function(d) { return y0(d.".$this->y_axis_key."); })
            .attr(\"height\", function(d,i,j) { return height - y0(d.".$this->y_axis_key."); });

        bars.append(\"rect\")
            .attr(\"class\", \"bar2\")
            .attr(\"x\", function(d) { return x(d.".$this->x_axis_key.") + x.bandwidth()/2; })
            .attr(\"width\", x.bandwidth() / 2)
            .attr(\"y\", function(d) { return y1(d.".$this->y_axis2_key."); })
            .attr(\"height\", function(d,i,j) { return height - y1(d.".$this->y_axis2_key."); });
    
        
        function type(d) {
            d.money = +d.money;
            return d;
        }";

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