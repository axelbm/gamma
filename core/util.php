<?php
class Util{
	static function SublimTab($tab, $name=null, $parent='base'){
		$id = 'SublimTab_'.$parent;
		$str = '[Array]';
		if(is_object($tab))
			$str = '[Object: '.get_class($tab).']';

		if(isset($name))
			$str = $name.' '.$str;

		$html  = '<a data-toggle="collapse" data-target="#'.$id.'">'.$str.'</a>
		';
		$html .= '<div id="'.$id.'" class="collapse in">
		';
		$html .= '<ul style="border-left: solid 1px; border-color: #337AB7;	list-style: none;">
		';

		if(empty($tab)){
			$html .= '<li>-- empty --</li>
			';
		}else{
			foreach ($tab as $key => $value) {
				$html .= '<li>';
				if(is_array($value) | is_object($value)){
					$html .= Util::SublimTab($value, $key, $parent.'_'.$key);
				}elseif(is_string($value)){
					$html .= $key.': "'.$value.'"';
				}elseif(is_null($value)){
					$html .= $key.': null';
				}else{
					$html .= $key.': '.$value;
				}

				$html .= '</li>
				';
			}
		}

		$html .= '</ul>
		';
		$html .= '</div>
		';

		return $html;
	}
}
?>