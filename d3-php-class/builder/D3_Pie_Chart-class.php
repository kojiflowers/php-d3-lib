<?php

class D3_Pie_Chart
{
    
    private $data_array = array();
    private $height = '';
    private $width = '';
    private $radius = '';
    public $chart_complete;

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
        
        $this->chart_complete = $this->build_simple_pie_chart();


    }

    public function __toString()
    {
        return $this->chart_complete;
    }

    function build_simple_pie_chart()
    {

        //example from https://gist.github.com/enjalot/1203641


        $return ='var w = '.$this->width.','."\n";                        //width
        $return .=' h = '.$this->height.','."\n";                           //height
        $return .=' r = '.$this->radius.','."\n";                            //radius
        $return .='color = d3.scale.ordinal()
    .range('.$this->colors.');'."\n"."\n";     //builtin range of colors
    $return .='data = ';
        $return.= json_encode($this->data_array);
        $return .='; ';
        $return .= 'var vis = d3.select("'.$this->render_element.'")'."\n";
        $return .= '.append("svg:svg")'."\n";               //create the SVG element inside the <body>
        $return .= '.data([data])'."\n";                 //associate our data with the document
        $return .= '.attr("width", w)'."\n";          //set the width and height of our visualization (these will be attributes of the <svg> tag
        $return .= '.attr("height", h)'."\n";
        $return .= '.append("svg:g")'."\n";              //make a group to hold our pie chart
        $return .= '.attr("transform", "translate(" + r + "," + r + ")")'."\n"."\n";    //move the center of the pie chart from 0, 0 to radius, radius
        $return .= 'var arc = d3.svg.arc()'."\n";              //this will create <path> elements for us using arc data
        $return .= '.outerRadius(r);'."\n"."\n";
        $return .= ' var pie = d3.layout.pie()'."\n";           //this will create arc data for us given a list of values
        $return .= '.value(function(d) { return d.value; });'."\n"."\n";    //we must tell it out to access the value of each element in our data array
        $return .= ' var arcs = vis.selectAll("g.slice")'."\n";    //this selects all <g> elements with class slice (there aren't any yet)
        $return .= '.data(pie)'."\n";                        //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties)
        $return .= '.enter()'."\n";                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
        $return .= '.append("svg:g")'."\n";             //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
        $return .= '.attr("class", "slice");'."\n"."\n";    //allow us to style things in the slices (like text)
        $return .= ' arcs.append("svg:path")'."\n";
        $return .= '.attr("fill", function(d, i) { return color(i); } )'."\n"; //set the color for each slice to be chosen from the color function defined above
        $return .= '.attr("d", arc);'."\n"."\n";                              //this creates the actual SVG path using the associated data (pie) with the arc drawing function
        $return .= ' arcs.append("svg:text")'."\n";                                    //add a label to each slice
        $return .= '.attr("transform", function(d) {'."\n";                    //set the label's origin to the center of the arc
        //we have to make sure to set these before calling arc.centroid
        $return .= 'd.innerRadius = 0;'."\n";
        $return .= 'd.outerRadius = r;'."\n";
        $return .= 'return "translate(" + arc.centroid(d) + ")";'."\n"."\n";        //this gives us a pair of coordinates like [50, 50]
        $return .= '})'."\n"."\n";
        $return .= '.attr("text-anchor", "middle")'."\n";                          //center the text on it's origin
        $return .= '.text(function(d, i) { return data[i].label; });'."\n";      //get the label from our original data array

        return $return;
    }
}