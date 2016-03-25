<?php
namespace Gamma\Old;

class Form_View{
	private $inputs = array();
	private $formid = "";
	private $data = array();
	private $formerror;
	private $formsuccess;
	private $inhorizontalform;

	function __construct($formid, $data=array(), $horizontal=null){
		$class = ($horizontal) ? 'form-horizontal' : '' ;
		$this->inhorizontalform = $horizontal;

		foreach ($data as $key => $value) {
			if(!isset($this->data[$key]) | empty($this->data[$key])){
				$this->data[$key] = array('error'=>null, 'value'=>$value);
			}
		}

		// $html = '<form class="'.$class.' '.$ac.'" id="'. $this->formid .'"" role="form" method="post">
		// if(empty($data)){
			$lastform = Controller::$self->form;

			if(isset($lastform) & !empty($lastform)){
				if($lastform->id == $formid){
					if(!empty($lastform->data)){
						$this->data = $lastform->data;
					}
					if(!empty($lastform->formerror)){
						$this->formerror = $lastform->formerror;
					}
					if(!empty($lastform->formsuccess)){
						$this->formsuccess = $lastform->formsuccess;
					}
				}
			}
		// }

		$this->formid 	= $formid;
		// $this->data	= $data;

		$html = '<form class="'.$class.'" id="'. $this->formid .'"" role="form" method="post">
		';
		echo $html;

		$this->hidden('formid', $formid);
	}

	function hidden($id, $value){
		$html = '<input name="'.$id.'" type="hidden" value="'.$value.'">
		';

		// array_push($this->inputs, $html);		
		echo $html;
	}

	function input($id, $value=null, $label=null, $type='text', $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-lg-2 control-label';
			$divclass = 'col-lg-10';
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
			<span class="help-block"><span class="text-danger">
			';
			$html .= $data['error'] . '
			</span></span';
		}


		$html .= '>
		</div>
		</div>
		';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function textarea($id, $value=null, $label=null, $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-lg-2 control-label';
			$divclass = 'col-lg-10';
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
			$html .= '<span class="help-block"><span class="text-danger">
			';
			$html .= $data['error'] . '
			</span></span>';
		}


		$html .= '</div>
		</div>
		';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function select($id, $values=array(), $label=null, $preset=null,$value='', $attributes=array()){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		$labelclass = '';
		$divclass = '';
		if($this->inhorizontalform){
			$labelclass = 'col-lg-2 control-label';
			$divclass = 'col-lg-10';
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

		if(isset($preset) & !empty($preset)){
			$html .= '<option value="">'.$preset.'</option>
			';
		}

		foreach ($values as $key => $value) {
			$s = '';
			if(isset($val) & $val == $key)
				$s = ' selected="selected"';

			$html .= '<option value="'.$key.'" '.$s.'>'.$value.'</option>
			';
		}

		$html .= '
		</select>
		';

		if(isset($data['error'])){
			$html .= '<span class="help-block"><span class="text-danger">
			';
			$html .= $data['error'] . '
			</span></span>';
		}


		$html .= '</div>
		</div>
		';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function checkbox($id, $label='', $checked=null){
		if(isset($this->data[$id]))
			$data = $this->data[$id];

		if(isset($data['value']) & !empty($data['value']))
			$checked = true;
		
		$class = ($this->inhorizontalform) ? 'col-lg-offset-2 col-lg-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<div class="checkbox">
					<label><input type="checkbox" name="'.$id.'" value="true" '.($checked?'checked':'').'>'.$label.'</label>
						';

					if(isset($data['error'])){
						$html .= '<span class="help-block"><span class="text-danger">
						';
						$html .= $data['error'] . '
						</span></span>';
					}
					$html .='
				</div>
			</div>
		</div>';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function submit($value,$style='default'){
		$class = ($this->inhorizontalform) ? 'col-lg-offset-2 col-lg-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<button type="submit" class="btn btn-'. $style .'">'. $value .'</button>
			</div>
		</div>';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function label($text, $h=null){
		$tag = (!empty($h) & is_numeric($h) & $h <= 6 & $h > 0) ? 'h'.$h : 'label';
		$class = ($this->inhorizontalform) ? 'col-lg-offset-2 col-lg-10' : '';

		$html = '
		<div class="form-group">
			<div class="'.$class.'">
				<'.$tag.'>'.$text.'</'.$tag.'>
			</div>
		</div>';

		// array_push($this->inputs, $html);
		echo $html;
	}

	function done($ac=''){
		// $class = ($this->inhorizontalform) ? 'form-horizontal' : '' ;

		// $html = '<form class="'.$class.' '.$ac.'" id="'. $this->formid .'"" role="form" method="post">
		// ';

		$html = '';

		if(!empty($this->formerror)){
			$html .= '<div class="alert alert-danger" style="padding:8px; margin-top:1px;">
			';
			$html .= $this->formerror . '
			</div>';
		}
		if(!empty($this->formsuccess)){
			$html .= '<div class="alert alert-success" style="padding:8px; margin-top:1px;">
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