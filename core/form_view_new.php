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

		$lastform = Controller::$self->newform;

		if(isset($lastform) & !empty($lastform)){
			if($lastform->ID() == $id){
				$this->data = $lastform->Objects();
			}
		}

		if(empty($this->data)){
			foreach ($data as $id => $value) {
				$obj = new Form_Object($id, $value);
				$this->data[$id] = $obj;
			}
		}
	}

	protected function surround($html, $status=0){
		switch ($status) {
			case 1:
				$status = " has-success";
				break;
			case 2:
				$status = " has-warning";
				break;
			case 3:
				$status = " has-error";
				break;
			
			default:
				$status = "";
				break;
		}

		return "<div class=\"form-group{$status}\">\n$html</div>\n";
	}

	protected function Value($index){
		if(isset($this->data[$index])){
			return $this->data[$index]->Value();
		}
	}

	protected function Message($index){
		if(isset($this->data[$index])){
			return $this->data[$index]->Message();
		}
	}

	protected function Status($index){
		if(isset($this->data[$index])){
			return $this->data[$index]->Status();
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
		$html .= $this->input(['id'=>'newform', 'value'=>true, 'type'=>'hidden'], false);

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
		$status    	= isset($opt['status'])    	? $opt['status']                         	: 0;

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

				if($this->Value($name)){
					array_push($attributes, 'checked');
				}elseif(!empty($value)){
					array_push($attributes, 'checked');
				}
			}
			elseif($type=="hidden"){
				$horizontal	= false;
				$label     	= null;
				$help      	= null;
				$surround  	= false;
			}else{
				$value = $this->Value($name) !== null? $this->Value($name):$value;
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
			$help = $this->Message($name) !== null? $this->Message($name):$help;

			if(isset($help) and !empty($help))
				$html .= $this->help($help);
		}

		//Horizontal end
		if($horizontal)
			$html .= "</div>\n";

		if($surround==true){
			$status = $this->Status($name) !== null? $this->Status($name):$status;
			$html = $this->surround($html, $status);
		}

		if($display)
			echo $html;

		return $html;
	}

	public function text($id, $value=null, $label=null, $type='text', $attributes=array()){
		return $this->input(['id'=>$id, 'label'=>$label, 'type'=>$type, 'attributes'=>$attributes]);
	}

	public function checkbox($id, $label='', $checked=null){
		$checked = $checked ? "on" : null;
		return $this->input(['id'=>$id, 'label'=>$label, 'type'=>'checkbox', 'value'=>$checked]);
	}

	public function submit($label){
		return $this->input(['id'=>'submit', 'type'=>'submit', 'label'=>$label]);
	}

	public function checkboxs($opt, $checkboxs, $display=true){

	}

}