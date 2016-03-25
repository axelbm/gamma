<?php
namespace Gamma;

class Util{
	static $subtabid = 0;

	static function SublimTab($tab, $name=null, $parent='base'){
		if(is_array($tab) | is_object($tab)){
			self::$subtabid = self::$subtabid + 1;
			$id = self::$subtabid.'_SublimTab_'.$parent;
			$str = '[Array]';
			if(is_object($tab)){
				$str = '[Object: '.get_class($tab).']';
				if(!isset($name)){
					$name = get_class($tab);
				}
			}

			if(isset($name))
				$str = $name.' '.$str;

			$html  = '<a data-toggle="collapse" data-target="#'.$id.'" style="cursor:pointer;">'.$str.'</a>
			';
			$html .= '<div id="'.$id.'" class="collapse">
			';
			$html .= '<ul style="border-left: solid 1px; border-color: #337AB7;	list-style: none; padding-left: 20px;">
			';

			if(empty($tab)){
				$html .= '<li>-- empty --</li>
				';
			}else{
				foreach ($tab as $key => $value) {
					$html .= '<li>';
					if(is_array($value) | is_object($value)){
						$html .= Util::SublimTab($value, $key, $parent.'_'.$key);
					}else{
						$html .= '<span class="text-primary">'.$key.'</span>' . ': ';
						if(is_string($value)){
							$html .= '"'.$value.'"';
						}elseif(is_bool($value)){
							if($value){
								$html .= 'true';
							}else{
								$html .= 'false';
							}
						}elseif(is_null($value)){
							$html .= 'null';
						}else{
							$html .= $value;
						}
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
		}else{
			return 'invalid';
		}
	}
}
?>