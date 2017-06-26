<?php
session_start();//开启缓存
header("content-type:text/html;charset=utf-8");

//提交短信
srand((double)microtime() * 1000000);
while (($authnum = rand() % 10000) < 1000) ;//生成四位随机整数验证码
$_SESSION['auth'] = $authnum;


//手机号
$phone = $_POST["Tel"];
if (!preg_match('/^[0-9]{11,13}$/', $phone)) {
    print("error");
    exit();
}

$post_data             = array();
$post_data['userid']   = 1754;
$post_data['account']  = 'mxjt';
$post_data['password'] = '336699';
$post_data['content']  = '【沐熙集团】验证码:' . $authnum;
$post_data['mobile']   = $phone;
$post_data['sendtime'] = ''; //不定时发送值为空，定时发送，输入格式YYYY-MM-DD HH：mm：ss的日期值
$url                   = 'http://115.29.242.32:8888/sms.aspx?action=send';
$o                     = '';
foreach ($post_data as $k => $v) {
    $o .= "$k=" . urlencode($v) . '&';
}
$post_data = substr($o, 0, -1);
$ch        = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$data = trim(curl_exec($ch));
curl_close($ch);
$startlen = strpos($data, 'charset=UTF-8') + strlen('charset=UTF-8');
$str      = trim(substr($data, $startlen, strlen($data) - $startlen));

if (strlen($str) > 1) {
    $_SESSION["authnum"] = $authnum;
    print($authnum);
    exit();
} else {
    print("error");
    exit();
}
?>