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
$check = array('name' => false,'sex' => 'false','school' => false,'num' => false,'qq' => false,'phone' => 'false');
if(empty($name) ||strlen($name) > 12) {
	echo json_encode(array('code' => -1, 'message' => '姓名填写不正确'));
	$cleanStudent['name'] = mysql_real_escape_string($name);
	$check['name'] = true;
}else if($sex != "汉子" &&　$sex != "妹子") {
	echo json_encode(array('code' => -1, 'message' => '性别填写不正确'));
	$cleanStudent['sex'] = mysql_real_escape_string($sex);
	$check['sex'] = true;
} else if($school != "信息科学与工程学院" && $school != "电气工程学院" && $school != "机械工程学院" && $school != "材料科学与工程学院" && 
	$school != "经济学院" && $school != "管理学院" && $school != "理学院" && $school != "建筑工程学院" && 
	$school != "文法学院" && $school != "外语学院" && $school != "软件学院" && $school != "基础教育学院" &&
	$school != "国防生教育学院" && $school != "国际教育学院" && $school != "马克思学院" && $school != "研究生学院" ) {
	echo json_encode(array('code' => -1, 'message' => '学院填写不正确'));
	$cleanStudent['school'] = mysql_real_escape_string($school);
	$check['school'] = true;
} else if(!ctype_digit($num) || strlen($num) != 9) {
	echo json_encode(array('code' => -1, 'message' => '学号填写不正确'));
	$cleanStudent['num'] = mysql_real_escape_string($num);
	$check['num'] = true;
} else if(!ctype_digit($qq) || strlen($qq) < 6 || strlen($qq) < 18 ) {
	echo json_encode(array('code' => -1, 'message' => 'qq号填写不正确'));
	$cleanStudent['qq'] = mysql_real_escape_string($qq);
	$check['qq'] = true;
}else if(!ctype_digit($phone) || strlen($phone) != 11) {
	echo json_encode(array('code' => -1, 'message' => '手机号填写不正确'));
	$cleanStudent['phone'] = mysql_real_escape_string($phone);
	$check['phone'] = true;
}
if($check['name'] == true && $check['sex'] == true && $check['school'] == true && $check['num'] == true &&
 $check['qq'] == true && $check['phone'] == true) {
	$sql = "insert into students (phone,sex,school,num,qq,name)  values('$cleanStudent[phone]','$cleanStudent[sex]','$cleanStudent[school]','$cleanStudent[num]','$cleanStudent[qq]','$cleanStudent[name]')";
 if (!mysql_query($sql,$con))
 {
   die('Error: ' . mysql_error());
 }
 
}
 
 mysql_close($con)
?>