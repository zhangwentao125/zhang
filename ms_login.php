<?php
require_once 'config.php';
var_dump($_POST);
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	$pwd_again=$_POST['pwd_again'];

	$yzm1 = $_POST['yzm1'];

	$yzm2 = $_POST['yzm2'];

	if ($yzm1 != $yzm2) {
        echo "验证码失败";
    }
if($password=="")
{
    echo"用户名或者密码不能为空";
}else{
    if($password!=$pwd_again)
    {
        echo"两次输入的密码不一致,请重新输入！";
        echo"<a href='index.php'>重新输入</a>";

    }
    else
    {
        $sql="insert into user(phone,password) values('$_POST[phone]','$_POST[password]')";
        $result=mysql_query($sql);
        if(!$result)
        {
            echo"注册不成功！";
            echo"<a href='index.php'>返回</a>";
        }
			else
        {
            echo"注册成功!";
        }
    }  
}   
?>  