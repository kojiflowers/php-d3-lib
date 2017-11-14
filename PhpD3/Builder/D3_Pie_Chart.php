<?php namespace PhpD3\Builder;

class D3_Pie_Chart
{
    public $chart_complete;
    
    protected $render_element;
    protected $data_array = array();
    protected $height = '';
    protected $width = '';
    protected $radius = '';

    function __construct($full_data_array=array())
    {
        $this->data_array = $full_data_array['chart_data'];
        $this->height=$full_data_array['dimensions']['height'];
        $this->width=$full_data_array['dimensions']['width'];
        $this->radius=$full_data_array['dimensions']['radius'];

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

        $return ="var w = ".$this->width.",
        h = ".$this->height.",
        r = ".$this->radius.",
        color = d3.scale.ordinal()
        .range(".$this->colors.");
        
        data = ".json_encode($this->data_array).";
        
        var vis = d3.select(\"".$this->render_element."\")
        .append(\"svg:svg\")
        .data([data])
        .attr(\"width\", w)
        .attr(\"height\", h)
        .append(\"svg:g\")
        .attr(\"transform\", \"translate(\" + r + \",\" + r + \")\")
        
        var arc = d3.svg.arc()
        .outerRadius(r);
        
         var pie = d3.layout.pie()
        .value(function(d) { return d.value; });
        
         var arcs = vis.selectAll(\"g.slice\")
        .data(pie)
        .enter()
        .append(\"svg:g\")
        .attr(\"class\", \"slice\");
        
         arcs.append(\"svg:path\")
        .attr(\"fill\", function(d, i) { return color(i); } )
        .attr(\"d\", arc);
        
         arcs.append(\"svg:text\")
        .attr(\"transform\", function(d) {
        d.innerRadius = 0;
        d.outerRadius = r;
        return \"translate(\" + arc.centroid(d) + \")\";
        
        })
        
        .attr(\"text-anchor\", \"middle\")
        .text(function(d, i) { return data[i].label; });
        ";

        return $return;
    }
}