<?php

namespace Cranberry;

class Util{
	public static function Sanitize($output){
		$output = filter_var($output, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$output = str_replace('javascript:', 'javascript&#58;', $output);

		return $output;
	}
}

?>