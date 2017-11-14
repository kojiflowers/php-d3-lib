<?php namespace PhpD3\Builder;

class D3_Bar_Graph
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

    function __construct($full_data_array=array())
    {

        $this->data_file = $full_data_array['data_file'];
        $this->height= (isset($full_data_array['dimensions']['height'])) ? $full_data_array['dimensions']['height'] : 500;
        $this->width= (isset($full_data_array['dimensions']['width'])) ? $full_data_array['dimensions']['width'] : 960;
        $this->x_axis_label = $full_data_array['axis_data']['x_axis_label'];
        $this->y_axis_label = $full_data_array['axis_data']['y_axis_label'];
        $this->margin_top = (isset($full_data_array['margins']['top'])) ? $full_data_array['margins']['top'] : 20;
        $this->margin_bottom = (isset($full_data_array['margins']['bottom'])) ? $full_data_array['margins']['bottom'] : 30;
        $this->margin_left = (isset($full_data_array['margins']['left'])) ? $full_data_array['margins']['left'] : 40;
        $this->margin_right = (isset($full_data_array['margins']['right'])) ? $full_data_array['margins']['right'] : 20;
        $this->file_type = (isset($full_data_array['file_type'])) ? $full_data_array['file_type'] : 'tsv';

        $this->render_element = '';
        if(isset($full_data_array['render_element']['value'])){

            $type = '#';

            if($full_data_array['render_element']['type'] == 'class'){
                $type='.';
            }

            $this->render_element = $type.$full_data_array['render_element']['value'];
        }

        if(isset($full_data_array['colors'])){

            $this->colors = '["'.implode('","', $full_data_array['colors']).'"]';

        }else{
            $this->colors = '["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]';
        }

        $this->chart_complete = $this->buildSimpleBarChart();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }


    function buildSimpleBarChart()
    {
        //example from https://gist.github.com/enjalot/1203641

       $return = "
        var margin = {top: ".$this->margin_top.", right: ".$this->margin_right.", bottom: ".$this->margin_bottom.", left: ".$this->margin_left."},
        width = ".$this->width." - margin.left - margin.right,
        height = ".$this->height." - margin.top - margin.bottom;";
       $return .= "var x = d3.scale.ordinal()
       .rangeRoundBands([0, width], .1);";

       $return .= "var y = d3.scale
       .linear()
       .range([height, 0]);";

       $return .= "var xAxis = d3.svg.axis()
       .scale(x)
       .orient(\"".$this->xAxisOrient."\");";

       $return .= "var yAxis = d3.svg.axis()
       .scale(y).orient(\"".$this->yAxisOrient."\")
       .ticks($this->ticks, \"%\");";

       $return .=" var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
            .attr(\"width\", width + margin.left + margin.right)
            .attr(\"height\", height + margin.top + margin.bottom)
            .append(\"g\")
            .attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");";

        $return.="
        
        d3.".$this->file_type."(\"".$this->data_file."\", type, function(error, data) {
          if (error) throw error;
        
          x.domain(data.map(function(d) { return d.".$this->x_axis_label."; }));
          y.domain([0, d3.max(data, function(d) { return d.".$this->y_axis_label."; })]);
        
          svg.append(\"g\")
              .attr(\"class\", \"x axis\")
              .attr(\"transform\", \"translate(0,\" + height + \")\")
              .call(xAxis);
        
          svg.append(\"g\")
              .attr(\"class\", \"y axis\")
              .call(yAxis)
              .append(\"text\")
              .attr(\"transform\", \"rotate(-90)\")
              .attr(\"y\", 6)
              .attr(\"dy\", \".71em\")
              .style(\"text-anchor\", \"end\")
              .text(\"".$this->y_axis_label."\");
        
          svg.selectAll(\".bar\")
              .data(data)
              .enter().append(\"rect\")
              .attr(\"class\", \"bar\")
              .attr(\"x\", function(d) { return x(d.".$this->x_axis_label."); })
              .attr(\"width\", x.rangeBand())
              .attr(\"y\", function(d) { return y(d.".$this->y_axis_label."); })
              .attr(\"height\", function(d) { return height - y(d.".$this->y_axis_label."); });
        });
        
        function type(d) {
          d.".$this->y_axis_label." = +d.".$this->y_axis_label.";
          return d;
        }";

        return $return;
    }
}