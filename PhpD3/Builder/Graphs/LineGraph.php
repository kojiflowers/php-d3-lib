<?php namespace PhpD3\Builder;

/**
 * Class LineGraph
 * @package PhpD3\Builder
 */
class LineGraph extends Builder
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
    protected $point_count;

    function __construct($full_data_array=array())
    {

        parent::__construct();

        $this->data_file = $full_data_array['data_file'];
        $this->file_type = (isset($full_data_array['file_type'])) ? $full_data_array['file_type'] : 'tsv';

        $this->autosize = (isset($full_data_array['autosize'])) ? $full_data_array['autosize'] : false;

        $this->data = (isset($full_data_array['chart_data'])) ? $full_data_array['chart_data'] : $this->prepData->run($this->data_file,$this->file_type);
        $this->point_count = count(json_decode($this->data));

        $this->height= (isset($full_data_array['dimensions']['height'])) ? $full_data_array['dimensions']['height'] : 500;
        $this->width= (isset($full_data_array['dimensions']['width'])) ? $full_data_array['dimensions']['width'] : 960;
        $this->x_axis_label = $full_data_array['axis_data']['x_axis_label'];
        $this->y_axis_label = $full_data_array['axis_data']['y_axis_label'];
        $this->margin_top = (isset($full_data_array['margins']['top'])) ? $full_data_array['margins']['top'] : 20;
        $this->margin_bottom = (isset($full_data_array['margins']['bottom'])) ? $full_data_array['margins']['bottom'] : 40;
        $this->margin_left = (isset($full_data_array['margins']['left'])) ? $full_data_array['margins']['left'] : 80;
        $this->margin_right = (isset($full_data_array['margins']['right'])) ? $full_data_array['margins']['right'] : 40;


        $this->generateRenderElement($full_data_array);

        $this->generateColors($full_data_array);

        $this->chart_complete = $this->buildGraph();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }

    function buildGraph(){

        $dimensions="
        
        // set the dimensions and margins of the graph
        var margin = {top: ".$this->margin_top.", right: ".$this->margin_right.", bottom: ".$this->margin_bottom.", left: ".$this->margin_left."},
        width = ".$this->width." - margin.left - margin.right,
        height = ".$this->height." - margin.top - margin.bottom;";

        $graph ="
        
        var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
        y = d3.scaleLinear().rangeRound([height, 0]);
        
        var data = ".$this->data.";
                  
        
        var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
        .attr(\"width\", width + margin.left + margin.right)
        .attr(\"height\", height + margin.top + margin.bottom)    
        
        
        var g = svg.append(\"g\")
        .attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");
        
        var line = d3.line()
        .x(function(d) { return x(d.".$this->x_axis_label.") + 15; })
        .y(function(d) { return y(d.".$this->y_axis_label."); })
        
        x.domain(data.map(function(d) { return d.".$this->x_axis_label."; }));
        y.domain([0, d3.max(data, function(d) { return d.".$this->y_axis_label."; })]);
        
        g.append(\"g\")
        .attr(\"class\", \"axis axis--x\")
        .attr(\"transform\", \"translate(0,\" + height + \")\")
        .call(d3.axisBottom(x))
        .selectAll(\"text\")
        .style(\"text-anchor\", \"end\")
        .attr(\"dx\", \"-.8em\")
        .attr(\"dy\", \".15em\")
        .attr(\"transform\", \"rotate(-65)\");
        
        g.append(\"g\")
        .attr(\"class\", \"axis axis--y\")
        .call(d3.axisLeft(y).tickValues(y.ticks(10).concat(y.domain())))
        .append(\"text\")
        .attr(\"transform\", \"rotate(-90)\")
        .attr(\"y\", 6)
        .attr(\"dy\", \"0.71em\")
        .attr(\"text-anchor\", \"end\")
        .text(\"".$this->y_axis_label."\");
        
        // add y axis label
        g.append(\"text\")
        .attr(\"transform\", \"rotate(-90)\")
        .attr(\"y\", 0 - margin.left)
        .attr(\"x\",0 - (height / 2))
        .attr(\"dy\", \"1em\")
        .style(\"text-anchor\", \"middle\")
        .attr(\"class\", \"axis-label\")
        .text(\"".ucfirst($this->y_axis_label)."\");      
        
        g.append(\"path\")
        .datum(data)
        .attr(\"class\", \"line\")
        .attr(\"d\", line);
        
        var div = d3.select(\"body\").append(\"div\")
        .attr(\"class\", \"tooltip\")
        .style(\"opacity\", 0);
        
        g.selectAll(\"circle\")
        .data(data)
        .enter().append(\"circle\")
        .attr(\"class\", \"circle\")
        .attr(\"cx\", function(d) { return x(d.".$this->x_axis_label.")+ 15; })
        .attr(\"cy\", function(d) { return y(d.".$this->y_axis_label."); })
        .attr(\"r\", 4)
        .on(\"mouseover\", function(d) {
            div.transition()
            .duration(200)
            .style(\"opacity\", .9);
            div.html(d.".$this->x_axis_label." + \"<br\/>\" + d.".$this->y_axis_label.")
            .style(\"left\", (d3.event.pageX) + \"px\")
            .style(\"top\", (d3.event.pageY - 28) + \"px\");
        })
        .on(\"mouseout\", function(d) {
            div.transition()
            .duration(500)
            .style(\"opacity\", 0);
        });
        
        // add x axis label
        g.append(\"text\")             
        .attr(\"transform\",\"translate(\" + (width/2) + \" ,\" + (height + margin.top + 20) + \")\")
        .style(\"text-anchor\", \"middle\")
        .attr(\"class\", \"axis-label\")
        .text(\"".ucfirst($this->x_axis_label)."\");

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

        return $return;
    }
}