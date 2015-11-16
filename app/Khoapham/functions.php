<?php
function stripUnicode($str){
	if(!$str)
		return false;
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 
		'A'=>'À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ',
		'd'=>'đ', 
		'D'=>'Đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 
		'E'=>'È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ',
		'i'=>'í|ì|ỉ|ĩ|ị', 
		'I'=>'Ì|Í|Ị|Ỉ|Ĩ',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 
		'O'=>'Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 
		'U'=>'Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 
		'Y'=>'Ỳ|Ý|Ỵ|Ỷ|Ỹ'

	);

	foreach($unicode as $khongdau=>$codau){
		//explode: dua ve mang: [0]=>'á', [1]=>'à', ...
		$arr = explode("|", $codau);

		//str_replace: thay chữ $arr bằng chữ $khongdau trong chuỗi $str
		$str = str_replace($arr, $khongdau, $str);
	}
	return $str;
}	

function changeTitle($str){
	if($str=="")
		return "";
	//bỏ hết các ký tự ' và "
	$str = str_replace('"', '', $str);
	$str = str_replace("'", '', $str);

	//chuyển chuỗi có dấu về không dấu
	$str = stripUnicode($str);

	//chuyển tất cả về chữ in thường
	$str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
	//MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER

	//thay các khoảng trắng bằng gạch ngang
	$str = str_replace(' ', '-', $str);
	return $str;
} 

function cate_parent($data, $parent = 0, $str= '----', $select=0){
	foreach($data as $value){
		$id = $value['id'];
		$name = $value['name'];
		if($parent == $value['parent_id']){
			if($select !=0 && $select == $id){
				echo "<option value='$id' selected='selected'>$str $name</option>";
			}
			else{
				echo "<option value='$id'>$str $name</option>";
			}
			cate_parent($data, $id, $str.'----',$select);
		}
	}
}
?>