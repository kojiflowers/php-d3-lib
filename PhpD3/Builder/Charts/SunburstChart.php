<?php namespace PhpD3\Builder;

/**
 * Class SunburstChart
 * @package PhpD3\Builder
 */
class SunburstChart extends Builder
{
    public $chart_complete;
    protected $radius = '';


    function __construct($full_data_array=array())
    {
        parent::__construct();

        $this->data_file = $full_data_array['data_file'];
        $this->file_type = (isset($full_data_array['file_type'])) ? $full_data_array['file_type'] : 'tsv';

        $this->data = (isset($full_data_array['chart_data'])) ? $full_data_array['chart_data'] : $this->prepData->run($this->data_file,$this->file_type);

        $this->height= $full_data_array['dimensions']['height'];
        $this->width= $full_data_array['dimensions']['width'];
        $this->autosize = (isset($full_data_array['autosize'])) ? $full_data_array['autosize'] : false;

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

        $chart ="var radius = (Math.min(width, height) / 2) - 10;

        var formatNumber = d3.format(\",d\");
        
        var x = d3.scaleLinear()
            .range([0, 2 * Math.PI]);
        
        var y = d3.scaleSqrt()
            .range([0, radius]);
        
        var color = d3.scaleOrdinal(d3.schemeCategory20);
        
        var partition = d3.partition();
        
        var arc = d3.arc()
            .startAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x0))); })
            .endAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x1))); })
            .innerRadius(function(d) { return Math.max(0, y(d.y0)); })
            .outerRadius(function(d) { return Math.max(0, y(d.y1)); });
        
        
        var svg = d3.select(\"".$this->render_element."\").append(\"svg\")
            .attr(\"width\", width)
            .attr(\"height\", height)
          .append(\"g\")
            .attr(\"transform\", \"translate(\" + width / 2 + \",\" + (height / 2) + \")\");
        
          root = ".$this->data.";
          root = d3.hierarchy(root);
          root.sum(function(d) { return d.size; });
          svg.selectAll(\"path\")
              .data(partition(root).descendants())
            .enter().append(\"path\")
              .attr(\"d\", arc)
              .style(\"fill\", function(d) { return color((d.children ? d : d.parent).data.name); })
              .on(\"click\", click)
            .append(\"title\")
              .text(function(d) { return d.data.name + formatNumber(d.value); });
        
        function click(d) {
          svg.transition()
              .duration(750)
              .tween(\"scale\", function() {
                var xd = d3.interpolate(x.domain(), [d.x0, d.x1]),
                    yd = d3.interpolate(y.domain(), [d.y0, 1]),
                    yr = d3.interpolate(y.range(), [d.y0 ? 20 : 0, radius]);
                return function(t) { x.domain(xd(t)); y.domain(yd(t)).range(yr(t)); };
              })
            .selectAll(\"path\")
              .attrTween(\"d\", function(d) { return function() { return arc(d); }; });
        }
    
        d3.select(self.frameElement).style(\"height\", height + \"px\");";

        $return = $dimensions.$chart;

        if($this->autosize){
            $return = $this->resize($this->render_element_id,$chart);
        }

        return $return;
    }
}