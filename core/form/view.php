<?php
namespace Gamma\Form;

class View{
	protected $id;
	protected $data;
	protected $horizontal	= false;
	protected $inline    	= false;
	protected $method    	= 'post';
	protected $messages  	= array();
	protected $token;
	protected $time;

	public function __construct($id, $data=array(), $formdata=array()){
		$this->id   	= $id;
		$this->token	= uniqid(rand(), true);
		$this->time 	= time();

		if(!empty($formdata)){
			$this->data = $formdata;
		}

		if(empty($this->data)){
			foreach ($data as $id => $value) {
				$obj = new Object($id, $value);
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

		return "<div class=\"form-group{$status}\">$html</div>";
	}

	public function inline($bool=true){
		$this->inline = $bool;
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

	public function inputlabel($id, $text){
		$horizontal = $this->horizontal ? 'col-sm-2 ' : '';

		return $html = "<label id=\"label_{$this->id}_{$id}\" for=\"input_{$this->id}_{$id}\" class=\"{$horizontal}control-label\">$text</label>";
	}

	public function help($text){
		return $html = "<p class=\"help-block\">$text</p>";
	}

	public function start($display=true){
		$horizontal = $this->horizontal ? 'form-horizontal' : '';
		$inline = $this->inline ? 'form-inline' : '';
		
		$_SESSION["forms_token"][$this->id] = array("token" => $this->token, "time" => $this->time);

		$html  = "<form id=\"{$this->id}\" class=\"{$horizontal}{$inline}\" role=\"form\" method=\"{$this->method}\">";
		$html .= $this->hidden('formid', $this->id, false);
		$html .= $this->hidden('token', $this->token, false);

		if($display)
			echo $html;

		return $html;
	}

	public function end($display=true){
		$html = "</form>";

		if($display)
			echo $html;

		return $html;
	}
    

	public function input($opt, $display=true){
		$id        	= isset($opt['id'])        	? $opt['id']                             	: '';
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
				$html .= "<div class=\"col-sm-offset-2 col-sm-10\">";

			$class	= !empty($class)      	? $class       	: ["btn","btn-default"];
			$label	= isset($opt['label'])	? $opt['label']	: 'Submit';

			$tag_class	= " class=\"".implode(' ', $class)."\"";
			$tag_name 	= isset($value)	? " name=\"{$name}\""  	: '';
			$tag_value	= isset($value)	? " value=\"{$value}\""	: '';
			
			$html .= "<button type=\"submit\" class=\"btn btn-default\"{$tag_name}{$tag_value}>{$label}</button>";
		}else{
			$formcontrol = true;

			if($type=="file" | $type=="label"){
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
				$html .= $this->inputlabel($id, $label);

			//Horizontal condition
			if($horizontal){
				$offset = isset($label) ? '' : 'col-sm-offset-2 ';
				$html .= "<div class=\"{$offset}col-sm-10\">";
			}

			if($type=="checkbox" or $type=="radio")
				$html .= "<div class=\"checkbox\"><label>";

			//Input
			if($formcontrol)
				array_push($class, 'form-control');


			if($required)      	{array_push($attributes, 'required');}
			if(isset($inputid))	{$attributes["id"]         	= $inputid ;}
			if(isset($name))   	{$attributes["name"]       	= $name ;}
			if(isset($value))  	{$attributes["value"]      	= $value ;}
			if(isset($holder)) 	{$attributes["placeholder"]	= $holder ;}
			if(!empty($class)) 	{$attributes["class"]      	= implode(' ', $class) ;}
			if(isset($type))   	{$attributes["type"]       	= $type ;}


			if($type == "textarea" | $type == "select" | $type == "label"){
				unset($attributes['type']);
				unset($attributes['value']);

				if($type == "label"){
					unset($attributes['name']);
					unset($attributes['id']);

					$size = isset($opt['size'])	? $opt['size']	: 0;
					$tag = ($size >= 1 and $size <=6) ? 'h'.$size : 'label';
				}else{
					$tag = $type;
				}
			}else{
				$tag = "input";
			}

			$html_attributes = array();

			foreach ($attributes as $key => $val) {
				if(is_numeric($key))
					array_push($html_attributes, $val);
				else
					array_push($html_attributes, "$key=\"$val\"");
			}

			$html_attributes = " ".implode(" ", $html_attributes);

			$html .= "<$tag {$html_attributes}>";

			if($type == "select"){
				$values	= isset($opt['values'])	? $opt['values']	: array();

				if(!empty($holder))
					$html .= "<option value=\"\">$holder</option>";

				$value = $this->Value($name) !== null? $this->Value($name):$value;

				foreach ($values as $key => $val) {
					$selected = (string)$value === (string)$key ? " selected" : "";
					$html .= "<option value=\"$key\"$selected>$val</option>";
				}
			}

			if($type == "textarea" | $type == "label"){
				if($type=="textarea")
					$value = $this->Value($name) !== null? $this->Value($name):$value;

				$html .= "$value";
			}

			if($type == "textarea" | $type == "select" | $type == "label")
				$html .= "</$tag>";

			if($type=="checkbox" or $type=="radio")
				$html .= "$afterlabel</label></div>";

			//Help
			$help = $this->Message($name) !== null? $this->Message($name):$help;

			if(isset($help) and !empty($help))
				$html .= $this->help($help);
		}

		//Horizontal end
		if($horizontal)
			$html .= "</div>";

		if($surround==true){
			$status = $this->Status($name) !== null? $this->Status($name):$status;
			$html = $this->surround($html, $status);
		}

		if($display)
			echo $html;

		return $html;
	}

	public function text($id, $value=null, $label=null, $type='text', $attributes=array(), $display=true){
		return $this->input(['id'=>$id, 'value'=>$value, 'label'=>$label, 'type'=>$type, 'attributes'=>$attributes], $display);
	}

	public function hidden($id, $value, $display=true){
		return $this->input(['id'=>$id, 'value'=>$value, 'type'=>'hidden'], $display);
	}

	public function checkbox($id, $label='', $checked=null, $display=true){
		$checked = $checked ? "on" : null;
		return $this->input(['id'=>$id, 'label'=>$label, 'type'=>'checkbox', 'value'=>$checked], $display);
	}

	public function submit($label, $display=true){
		return $this->input(['id'=>'submit', 'type'=>'submit', 'label'=>$label], $display);
	}

	public function select($id, $values=array(), $label=null, $preset=null, $value='', $attributes=array(), $display=true){
		return $this->input(['id'=>$id, 'type'=>'select', 'label'=>$label, 'holder'=>$preset, 'value'=>$value, 'values'=>$values, 'attributes'=>$attributes], $display);
	}

	public function label($text, $size=0, $display=true){
		return $this->input(['type'=>'label', 'value'=>$text, 'size'=>$size], $display);
	}

	public function textarea($id, $value=null, $label=null, $attributes=array(), $display=true){
		return $this->input(['id'=>$id, 'value'=>$value, 'label'=>$label, 'type'=>'textarea', 'attributes'=>$attributes], $display);
	}

	public function checkboxs($opt, $checkboxs, $display=true){

	}

}