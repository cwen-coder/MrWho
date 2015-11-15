document.getElementById('btn').onclick = function(){
	var sex = document.getElementById('sex');
	var name = document.getElementById('name');
	var num = document.getElementById('num');
	var qq = document.getElementById('qq');
	var phone = document.getElementById('phone');
	var school = document.getElementById('school');
	var phoneWord = document.getElementById('phoneWord');
	var qqWord = document.getElementById('qqWord');
	var numWord = document.getElementById('numWord');

var tel = $("#phone").val(); //获取手机号
var q = $('#qq').val();
var nu =$('#num').val(); 
var qreg = !!q.match(/[0-9]\d{4,10}/);
var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
var nureg = !!nu.match(/^\d{9}$/);
if(telReg == true&&qreg == true&&nureg == true){
	$('.tip').text('');
	$.ajax({
		url: './a.php',
		type: 'POST', 
		data: {
			name:name.value,
			sex:sex.value,
			school:school.value,
			num:num.value,
			qq:qq.value,
			phone:phone.value
		},
		success:function(data,status){
			data = JSON.parse(data);
			if(data['code'] != 1) {
				alert(data['message']);
			} else {
				alert(data['message']);
				window.location.href='http://youth.sut.edu.cn';
			}
		}
	})
	.done(function() {
		console.log("success");
		$('.hidden').css("display","block");
		$('.click').css({
			background: '#999',
		});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}
if(telReg == false){
		phoneWord.innerHTML = "手机号码填写错误";
}else{
	phoneWord.innerHTML = "";
}
if(qreg == false){
		qqWord.innerHTML = "qq号码填写错误";
}else{
	qqWord.innerHTML = "";
}
if(nureg == false){
	numWord.innerHTML = "学号填写错误";
}else{
	numWord.innerHTML = "";
}
}