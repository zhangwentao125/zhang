<?php
session_start();//开启缓存
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>示例1</title>

<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">

function get(obj) {
    var mobile = /^\d{10,13}$/;
    if (!mobile.test(document.getElementById("TextBox1").value)) {
        alert('请输入正确的手机号码');
        return;
    }
  obj.disabled = true;
  $.ajax({
      url: "getcode.php",
      type: "Post",
      data: "Tel=" + $("#TextBox1").val(),
      success: function(msg) {
          obj.disabled = false;
          if (msg) {
              alert("生成成功!请等侍短信提示。");
              $('#yzm2').val(msg);
              return;
          }
          if (msg == "error") {
              alert("生成失败!请联系管理员")
              return;
          }
          alert(msg);
      }
  }) 
 }   
 //倒计时  
var countdown=60;  
function settime(val) {
    if (countdown == 0) {  
        val.removeAttribute("disabled");  
        val.value="获取验证码";  
        countdown = 60;  
        return false;  
    } else {
//        val.setAttribute("disabled", true);
        val.value="重新发送(" + countdown + ")";  
        countdown--;  
    }  
    setTimeout(function() {  
        settime(val);  
    },1000);  
}  
</script>
</head>

<body>
<label>
<form id="form1" name="form1" method="post" action="ms_login.php">
手机号：<input name="phone" type="text" id="TextBox1" /> 
<input id="Button1" class="obtain generate_code" type="button" value="获取短信验证码" onClick="get(this);settime(this);" />
<br />
密码:<input type="password" name="password">
<br />
再次输入密码：<input type="password" name="pwd_again">
<br />
验证码：<input name="yzm1" type="text" id="TextBox2" />
<input name="yzm2" type="hidden" id="yzm2" value=""/>

<br />
<label>
<input type="submit" name="Submit" value=" 确 定 "  />
</label>
</form>
<p>&nbsp;</p>
</body>
</html>

