<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Codewriter{
		
		public function include_js($filename){
			echo '<script type="text/javascript" language="javascript" src="$filename">';
			echo '</script>\n';
			
