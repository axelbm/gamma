<?php
class Form_View{
	private $inputs = array();
	private $formid = "";
	private $data = array();

	function __construct($formid, $data=array()){
		$this->formid	= $formid;
		$this->data  	= $data;

		$this->hidden('formid', $formid);
	}

	function hidden($id, $value){
		$html = '<input name="'.$id.'" type="hidden" value="'.$value.'">
		';

		array_push($this->inputs, $html);		
	}

	function input($id, $value=null, $label=null, $type='text', $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$html = '<div class="form-group">
		';
		if(isset($label)){
			$html .= '<label for="'.$this->formid."-".$id.'">'.$label.'</label>
			';
		}
		$html .= '<input type="'.$type.'" class="form-control" id="'.$this->formid.'-'.$id.'" name="'.$id.'" ';
		if(isset($data['value'])){
			$html .= 'value="'. $data['value'] .'" ';
		}elseif(isset($value)){
			$html .= 'value="'. $value .'" ';
		}

		foreach ($attributes as $key => $value) {
			$html .= $key .'="'. $value .'" ';
		}

		if(isset($data['error'])){
			$html .= '>
			<div class="alert alert-danger" style="padding:8px; margin-top:1px;">
			';
			$html .= $data['error'] . '
			</div';
		}


		$html .= '>
		</div>
		';

		array_push($this->inputs, $html);
	}


	// <div class="checkbox">
	//	<label><input type="checkbox" name="rm">Se souvenir de moi</label>
	// </div>
	function checkbox($id, $label=''){
		$html = '<div class="checkbox">
		<label><input type="checkbox" name="'.$id.'">'.$label.'</label>
		</div>';

		array_push($this->inputs, $html);
	}

	function submit($value,$style='default'){
		$html = '<button type="submit" class="btn btn-'. $style .'">'. $value .'</button>
		';

		array_push($this->inputs, $html);
	}

	function done(){
		$html = '<form id="'. $this->formid .'"" role="form" method="post">
		';
		foreach ($this->inputs as $key => $value) {
			$html .= $value;
		}
		$html .= '</form>
		';

		echo $html;
	}
}
?>