<?php

class HhtHelper extends AppHelper {
  	
	function file_image($file, $type='small'){
		$postfix = explode('.',$file);
		$postfix = array_pop($postfix);
		return strtoupper($postfix);
	}
	
	function file_size($file){
		$size = filesize($file);
		$size_k = $size/1024;
		return ceil($size_k).'k';
	}
	
	function file_type($file){
		$fileType = array(
			'bmp' => 'image/bmp',
			'gif' => 'image/gif',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'png' => 'image/png',
			'doc' => 'application/msword',
			'pdf' => 'application/pdf',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',
			'xls' => 'application/vnd.ms-excel'
		);
		$postfix = strtolower($this->file_image($file));
		$type = explode('/',$fileType[$postfix]);
		return $type[0];
	}
	
	function list_view($array, $list){
		$new = array();
		$count = count($array);
		$list = ($count<$list) ? $count : $list;
		for($i=0; $i<$list; $i++){
			if($i<($count%$list)){
				$new[$i] = array_splice($array, 0, floor($count/$list)+1);
			}else{
				$new[$i] = array_splice($array, 0, floor($count/$list));
			}
		}
		return $new;
	}
	
	function time_a($type){
		for($i=1; $i<=12; $i++){
			$h[] = $i;	
		}
		
		for($i=0; $i<=59; $i++){
			$m[] = $i;	
		}
		
		return ${$type};
	}
	
}

?>
