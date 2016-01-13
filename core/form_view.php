<?php
class Form_View{
	private $inputs = array();
	private $formid = "";
	private $data = array();
	private $formerror;
	private $inhorizontalform;

	function __construct($formid, $data=array()){
		if(empty($data)){
			$lastform = Controller::$self->form;

			if(isset($lastform) & !empty($lastform)){
				if($lastform->id == $formid){
					if(!empty($lastform->data)){
						$data = $lastform->data;
					}
					if(!empty($lastform->formerror)){
						$this->formerror = $lastform->formerror;
					}
				}
			}
		}

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

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-sm-2 control-label';
			$divclass = 'col-sm-10';
		}

		$html = '<div class="form-group">
		';
		if(isset($label)){
			$html .= '<label class="'.$labelclass.'" for="'.$this->formid."-".$id.'">'.$label.'</label>
			';
		}

		$html .= '<div class="'.$divclass.'">
		';

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
		</div>
		';

		array_push($this->inputs, $html);
	}

	function textarea($id, $value=null, $label=null, $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-sm-2 control-label';
			$divclass = 'col-sm-10';
		}

		$html = '<div class="form-group">
		';
		if(isset($label)){
			$html .= '<label class="'.$labelclass.'" for="'.$this->formid."-".$id.'">'.$label.'</label>
			';
		}

		$html .= '<div class="'.$divclass.'">
		';

		$html .= '<textarea class="form-control" id="'.$this->formid.'-'.$id.'" name="'.$id.'" ';

		foreach ($attributes as $key => $value) {
			$html .= $key .'="'. $value .'" ';
		}

		$html .= '>';

		if(isset($data['value'])){
			$html .= $data['value'];
		}elseif(isset($value)){
			$html .= $value;
		}

		$html .= '</textarea>
		';

		if(isset($data['error'])){
			$html .= '<div class="alert alert-danger" style="padding:8px; margin-top:1px;">
			';
			$html .= $data['error'] . '
			</div';
		}


		$html .= '</div>
		</div>
		';

		array_push($this->inputs, $html);
	}

	function select($id, $values=array(), $label=null, $value='', $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-sm-2 control-label';
			$divclass = 'col-sm-10';
		}

		$html = '<div class="form-group">
		';
		if(isset($label)){
			$html .= '<label class="'.$labelclass.'" for="'.$this->formid."-".$id.'">'.$label.'</label>
			';
		}

		$html .= '<div class="'.$divclass.'">
		';

		$html .= '<select class="form-control" id="'.$this->formid.'-'.$id.'" name="'.$id.'" ';

		foreach ($attributes as $key => $value) {
			$html .= $key .'="'. $value .'" ';
		}
		$html .= '>';

		if(isset($data['value'])){
			$val = $data['value'];
		}elseif(isset($value)){
			$val = $value;
		}


		foreach ($values as $key => $value) {
			$s = '';
			if($val == $key)
				$s = ' selected="selected"';

			$html .= '<option value="'.$key.'" '.$s.'>'.$value.'</option>
			';
		}

		$html .= '
		</select>
		';

		if(isset($data['error'])){
			$html .= '<div class="alert alert-danger" style="padding:8px; margin-top:1px;">
			';
			$html .= $data['error'] . '
			</div>';
		}


		$html .= '</div>
		</div>
		';

		array_push($this->inputs, $html);
	}

	// <div class="checkbox">
	//	<label><input type="checkbox" name="rm">Se souvenir de moi</label>
	// </div>
	function checkbox($id, $label=''){
		$class = ($this->inhorizontalform) ? 'col-sm-offset-2 col-sm-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<div class="checkbox">
					<label><input type="checkbox" name="'.$id.'">'.$label.'</label>
				</div>
			</div>
		</div>';

		array_push($this->inputs, $html);
	}

	function submit($value,$style='default'){
		$class = ($this->inhorizontalform) ? 'col-sm-offset-2 col-sm-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<button type="submit" class="btn btn-'. $style .'">'. $value .'</button>
			</div>
		</div>';

		array_push($this->inputs, $html);
	}

	function label($text, $h=null){
		$tag = (!empty($h) & is_numeric($h) & $h <= 6 & $h > 0) ? 'h'.$h : 'label';
		$class = ($this->inhorizontalform) ? 'col-sm-offset-2 col-sm-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<'.$tag.'>'.$text.'</'.$tag.'>
			</div>
		</div>';

		array_push($this->inputs, $html);
	}

	function done(){
		$class = ($this->inhorizontalform) ? 'form-horizontal' : '' ;

		$html = '<form class="'.$class.'" id="'. $this->formid .'"" role="form" method="post">
		';

		if(!empty($this->formerror)){
			$html .= '<div class="alert alert-danger" style="padding:8px; margin-top:1px;">
			';
			$html .= $this->formerror . '
			</div>';
		}

		foreach ($this->inputs as $key => $value) {
			$html .= $value;
		}
		$html .= '</form>
		';

		echo $html;
	}

	function horizontal(){
		$this->inhorizontalform = true;
	}
}
?>