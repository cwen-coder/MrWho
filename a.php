<?php 
require('connect.php');

header("Content-type: text/html; charset=utf-8");
$name = $_POST['name'];
$sex = $_POST['sex'];
$school = $_POST['school'];
$num = $_POST['num'];
$qq = $_POST['qq'];
$phone = $_POST['phone'];
$cleanStudent = array();
$check = array('name' => true,'sex' => true,'school' => true,'num' => true,'qq' => true,'phone' => true);
if(empty($name)||strlen($name) > 12) {
	echo json_encode(array('code' => -1, 'message' => '姓名填写不正确'));
	$check['name'] = false;
}else if($sex != "男"&&$sex != "女") {
	echo json_encode(array('code' => -1, 'message' => '性别填写不正确'));	
	$check['sex'] = false;
} else if($school != "信息科学与工程学院"&&$school != "电气工程学院"&&$school != "机械工程学院"&&$school != "材料科学与工程学院"&& 
	$school != "经济学院"&&$school != "管理学院"&&$school != "理学院"&&$school != "建筑工程学院"&& 
	$school != "文法学院"&&$school != "外语学院"&&$school != "软件学院"&&$school != "基础教育学院"&&
	$school != "国防生教育学院"&&$school != "国际教育学院"&&$school != "马克思学院"&&$school != "研究生学院" ) {
	echo json_encode(array('code' => -1, 'message' => '学院填写不正确'));
	$check['school'] = false;
} else if(!ctype_digit($num) || strlen($num) != 9) {
	echo json_encode(array('code' => -1, 'message' => '学号填写不正确'));
	$check['num'] = false;
} else if(!ctype_digit($qq) || strlen($qq) < 6 || strlen($qq) > 18 ) {
	echo json_encode(array('code' => -1, 'message' => 'qq号填写不正确'));
	$check['qq'] = false;
}else if(!ctype_digit($phone) || strlen($phone) != 11) {
	echo json_encode(array('code' => -1, 'message' => '手机号填写不正确'));
	$check['phone'] = false;
}


if($check['name'] == true && $check['sex'] == true && $check['school'] == true && $check['num'] == true &&
 $check['qq'] == true && $check['phone'] == true) {
 	$cleanStudent['name'] = mysql_real_escape_string($name,$con);
 	$cleanStudent['sex'] = mysql_real_escape_string($sex,$con);
 	$cleanStudent['school'] = mysql_real_escape_string($school,$con);
 	$cleanStudent['num'] = mysql_real_escape_string($num,$con);
 	$cleanStudent['qq'] = mysql_real_escape_string($qq,$con);
 	$cleanStudent['phone'] = mysql_real_escape_string($phone,$con);
 	$sql1 = "SELECT * from students WHERE num = '$cleanStudent[num]' ";
 	$result = mysql_query($sql1);
 	if($result) {
 		$n = mysql_num_rows($result);
 		if($n > 0) {
 			echo json_encode(array('code' => -1, 'message' => '对不起学号已被注册'));
 		} else{
 				$sql = "insert into students (phone,sex,school,num,qq,name)  values('$cleanStudent[phone]','$cleanStudent[sex]','$cleanStudent[school]','$cleanStudent[num]','$cleanStudent[qq]','$cleanStudent[name]')";
 				 if (!mysql_query($sql,$con))
 				 {
 				   die('Error: ' . mysql_error());
 				 }
 			 echo json_encode(array('code' => 1, 'message' => '报名成功'));
 		}
 	} else {
 		die('Error: ' . mysql_error());
 	} 
	
}
 
 mysql_close($con)
?>