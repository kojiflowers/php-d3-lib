<?php namespace PhpD3\Builder;

/**
 * Class D3_Stacked_Bar_Graph
 * @package PhpD3\Builder
 */
class D3_Stacked_Bar_Graph
{
    public $chart_complete;

    protected $data = '';
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
        $this->data = $full_data_array['data'];

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

        $this->chart_complete = $this->buildGraph();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }

    function buildGraph(){



        $return ="var n = 4, // The number of series.
        m = 58; // The number of values per series.

        // The xz array has m elements, representing the x-values shared by all series.
        // The yz array has n elements, representing the y-values of each of the n series.
        // Each yz[i] is an array of m non-negative numbers representing a y-value for xz[i].
        // The y01z array has the same structure as yz, but with stacked [y₀, y₁] instead of y.
        var xz = d3.range(m),
            yz = d3.range(n).map(function() { return data; }),
            y01z = d3.stack().keys(d3.range(n))(d3.transpose(yz)),
            yMax = d3.max(yz, function(y) { return d3.max(y); }),
            y1Max = d3.max(y01z, function(y) { return d3.max(y, function(d) { return d[1]; }); });
    
        var svg = d3.select(\"svg\"),
            margin = {top: 40, right: 10, bottom: 20, left: 10},
            width = +svg.attr(\"width\") - margin.left - margin.right,
            height = +svg.attr(\"height\") - margin.top - margin.bottom,
            g = svg.append(\"g\").attr(\"transform\", \"translate(\" + margin.left + \",\" + margin.top + \")\");
    
        var x = d3.scaleBand()
            .domain(xz)
            .rangeRound([0, width])
            .padding(0.08);
    
        var y = d3.scaleLinear()
            .domain([0, y1Max])
            .range([height, 0]);
    
        var color = d3.scaleOrdinal()
            .domain(d3.range(n))
            .range(d3.schemeCategory20c);
    
        var series = g.selectAll(\".series\")
            .data(y01z)
            .enter().append(\"g\")
            .attr(\"fill\", function(d, i) { return color(i); });
    
        var rect = series.selectAll(\"rect\")
            .data(function(d) { return d; })
            .enter().append(\"rect\")
            .attr(\"x\", function(d, i) { return x(i); })
            .attr(\"y\", height)
            .attr(\"width\", x.bandwidth())
            .attr(\"height\", 0);
    
        rect.transition()
            .delay(function(d, i) { return i * 10; })
            .attr(\"y\", function(d) { return y(d[1]); })
            .attr(\"height\", function(d) { return y(d[0]) - y(d[1]); });
    
        g.append(\"g\")
            .attr(\"class\", \"axis axis--x\")
            .attr(\"transform\", \"translate(0,\" + height + \")\")
            .call(d3.axisBottom(x)
                .tickSize(0)
                .tickPadding(6));
    
        d3.selectAll(\"input\")
            .on(\"change\", changed);
    
        var timeout = d3.timeout(function() {
            d3.select(\"input[value='grouped']\")
                .property(\"checked\", true)
                .dispatch(\"change\");
        }, 2000);
    
        function changed() {
            timeout.stop();
            if (this.value === \"grouped\") transitionGrouped();
            else transitionStacked();
        }
    
        function transitionGrouped() {
            y.domain([0, yMax]);
    
            rect.transition()
                .duration(500)
                .delay(function(d, i) { return i * 10; })
                .attr(\"x\", function(d, i) { return x(i) + x.bandwidth() / n * this.parentNode.__data__.key; })
                .attr(\"width\", x.bandwidth() / n)
                .transition()
                .attr(\"y\", function(d) { return y(d[1] - d[0]); })
                .attr(\"height\", function(d) { return y(0) - y(d[1] - d[0]); });
        }
    
        function transitionStacked() {
            y.domain([0, y1Max]);
    
            rect.transition()
                .duration(500)
                .delay(function(d, i) { return i * 10; })
                .attr(\"y\", function(d) { return y(d[1]); })
                .attr(\"height\", function(d) { return y(d[0]) - y(d[1]); })
                .transition()
                .attr(\"x\", function(d, i) { return x(i); })
                .attr(\"width\", x.bandwidth());
        }";

        return $return;

    }
}