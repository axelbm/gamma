<?php
// namespace StoryHub\Tools;

class Form_View_New{
	protected $id;
	protected $data;
	protected $horizontal	= false;
	protected $inline    	= false;
	protected $method    	= 'post';

	public function __construct($id, $data=array()){
		$this->id = $id;
		$this->data = $data;

		$this->data = $_POST;

	}

	protected function surround($html){
		return "<div class=\"form-group\">\n$html</div>\n";
	}

	protected function get($index){
		if(isset($this->data[$index])){
			return $this->data[$index];
		}
	}

	public function method($type){
		if($type == "get" or $type == "post"){
			$this->method = $type;
		}
	}

	public function horizontal($bool=true){
		$this->horizontal = $bool;
	}

	public function inline($bool=true){
		$this->inline = $bool;
	}

	public function label($id, $text){
		$horizontal = $this->horizontal ? 'col-sm-2 ' : '';

		return $html = "<label id=\"label_{$this->id}_{$id}\" for=\"input_{$this->id}_{$id}\" class=\"{$horizontal}control-label\">$text</label>\n";
	}

	public function help($text){
		return $html = "<p class=\"help-block\">$text</p>\n";
	}

	public function start($display=true){
		$horizontal = $this->horizontal ? 'form-horizontal' : '';

		$html  = "\n<form id=\"{$this->id}\" class=\"$horizontal\" role=\"form\" method=\"{$this->method}\">\n";
		$html .= $this->input(['id'=>'formid', 'value'=>$this->id, 'type'=>'hidden'], false);

		if($display)
			echo $html;

		return $html;
	}

	public function end($display=true){
		$html = "</form>\n";

		if($display)
			echo $html;

		return $html;
	}
    

	public function input($opt, $display=true){
		$id        	= $opt['id'];
		$name      	= isset($opt['name'])      	? $opt['name']                           	: $id;
		$label     	= isset($opt['label'])     	? $opt['label']                          	: null;
		$type      	= isset($opt['type'])      	? $opt['type']                           	: 'text';
		$help      	= isset($opt['help'])      	? $opt['help']                           	: null;
		$holder    	= isset($opt['holder'])    	? $opt['holder']                         	: null;
		$required  	= isset($opt['required'])  	? ($opt['required'] ? ' required' : null)	: null;
		$class     	= isset($opt['class'])     	? $opt['class']                          	: array();
		$surround  	= isset($opt['surround'])  	? $opt['surround']                       	: true;
		$attributes	= isset($opt['attributes'])	? $opt['attributes']                     	: array();
		$value     	= isset($opt['value'])     	? $opt['value']                          	: null;

		$horizontal	= $this->horizontal;
		$inputid   	= "input_{$this->id}_{$id}";
		$html      	= '';

		if($type == "submit"){
			if($horizontal)
				$html .= "<div class=\"col-sm-offset-2 col-sm-10\">\n";

			$class	= !empty($class)      	? $class       	: ["btn","btn-default"];
			$label	= isset($opt['label'])	? $opt['label']	: 'Submit';

			$tag_class	= " class=\"".implode(' ', $class)."\"";
			$tag_name 	= isset($value)	? " name=\"{$name}\""  	: '';
			$tag_value	= isset($value)	? " value=\"{$value}\""	: '';
			
			$html .= "<button type=\"submit\" class=\"btn btn-default\"{$tag_name}{$tag_value}>{$label}</button>";
		}else{
			$formcontrol = true;

			if($type=="file"){
				$formcontrol = false;
			}elseif($type=="checkbox" or $type=="radio"){
				$afterlabel 	= $label;
				$label      	= null;
				$formcontrol	= false;

				$value = isset($value) ? $value : 'on';
				if($value == $this->get($name))
					array_push($attributes, 'checked');
			}
			elseif($type=="hidden"){
				$horizontal	= false;
				$label     	= null;
				$help      	= null;
				$surround  	= false;
			}else{
				$value = $this->get($name)?:$value;
			}

			//Label
			if(isset($label))
				$html .= $this->label($id, $label);

			//Horizontal condition
			if($horizontal){
				$offset = isset($label) ? '' : 'col-sm-offset-2 ';
				$html .= "<div class=\"{$offset}col-sm-10\">\n";
			}

			if($type=="checkbox" or $type=="radio")
				$html .= "<div class=\"checkbox\">\n<label>\n";

			//Input
			if($formcontrol)
				array_push($class, 'form-control');


			if($required)     	{array_push($attributes, 'required');}
			if(isset($value)) 	{$attributes["value"]      	= $value ;}
			if(isset($holder))	{$attributes["placeholder"]	= $holder ;}
			if(!empty($class))	{$attributes["class"]      	= implode(' ', $class) ;}
			if(isset($type))  	{$attributes["type"]       	= $type ;}



			$html_attributes	= array();

			foreach ($attributes as $key => $value) {
				if(is_numeric($key))
					array_push($html_attributes, $value);
				else
					array_push($html_attributes, "$key=\"$value\"");
			}

			$html_attributes = " ".implode(" ", $html_attributes);

			$html .= "<input id=\"$inputid\" name=\"$name\"{$html_attributes}>\n";

			if($type=="checkbox" or $type=="radio")
				$html .= "$afterlabel</label>\n</div>\n";

			//Help
			if(isset($help))
				$html .= $this->help($help);
		}

		//Horizontal end
		if($horizontal)
			$html .= "</div>\n";

		if($surround==true)
			$html = $this->surround($html);

		if($display)
			echo $html;

		return $html;
	}


	public function checkboxs($opt, $checkboxs, $display=true){

	}

	public function submit($opt=[]){

	}
}