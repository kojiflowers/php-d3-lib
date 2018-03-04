<?php namespace PhpD3\Builder;

/**
 * Class PieChart
 * @package PhpD3\Builder
 */
class PieChart extends Builder
{
    public $chart_complete;
    protected $radius = '';


    function __construct($full_data_array=array())
    {
        parent::__construct();

        $this->data_array = $full_data_array['chart_data'];
        $this->height= $full_data_array['dimensions']['height'];
        $this->width= $full_data_array['dimensions']['width'];
        $this->radius= $full_data_array['dimensions']['radius'];
        $this->autosize = (isset($full_data_array['autosize'])) ? $full_data_array['autosize'] : false;

        $this->data = $this->prepData->run($this->data_array);

        $this->render_element = '';
        $this->generateRenderElement($full_data_array);

        $this->generateColors($full_data_array);
        
        $this->chart_complete = $this->buildChart();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }

    function buildChart(){

        $dimensions = "
        var width = ".$this->width.";
        var height = ".$this->height.";";

        $chart ="
            
        var radius = Math.min(width, height) / 2;
        
        var  data = ".$this->data.";
        
        var color = d3.scaleOrdinal()
        .range(".$this->colors.");
        
        var arc = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);
        
        var labelArc = d3.arc()
        .outerRadius(radius - 40)
        .innerRadius(radius - 40);
        
        var pie = d3.pie()
        .sort(null)
        .value(function(d) { return d.value; });
        
        var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
        .attr(\"width\", width)
        .attr(\"height\", height)
        .append(\"g\")
        .attr(\"transform\", \"translate(\" + width / 2 + \",\" + height / 2 + \")\");
        
        var g = svg.selectAll(\".arc\")
        .data(pie(data))
        .enter().append(\"g\")
        .attr(\"class\", \"arc\");
        
        g.append(\"path\")
        .attr(\"d\", arc)
        .attr(\"fill\", function(d, i) { return color(i); } )
        
        g.append(\"text\")
        .attr(\"transform\", function(d) { return \"translate(\" + labelArc.centroid(d) + \")\"; })
        .attr(\"dy\", \".35em\")
        .text(function(d, i) { return data[i].label; });";

        $return = $dimensions.$chart;

        if($this->autosize){
            $return = $this->resize($this->render_element_id,$chart);
        }

        return $return;
    }
}