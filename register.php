<?php
//gmp extension
//mysqli
if (!empty($_POST)) {
    require_once ("./tools.php");

    $sName = $_POST["name"];
    $sEmail = $_POST["email"];
    $sPwd = $_POST["password"];

    //db
    $aDbConfig = [
        'adapter'   => 'Mysql',
        'host'      => 'docker.for.mac.host.internal',
        'username'  => 'root',
        'password'  => '123456',
        'port'      => '3506',
        'dbname'    => 'mpool',
        'charset'   => 'utf8mb4',
    ];

    $oAccount = new stdClass();
    $oAccount->username = strtoupper($sName);
    $oAccount->email = $sEmail;
    $oAccount->reg_mail = $sEmail;
    $oAccount->last_ip = $_SERVER['REMOTE_ADDR'];
    $oAccount->last_login = date("Y-m-d H:i:s");

    list($salt, $verifier) = GetSRP6RegistrationData($sName, $sPwd);

    $oAccount->salt = $salt;
    $oAccount->verifier = $verifier;

    if (!regHandler($oAccount, $aDbConfig)) {
        echo "<script>alert('创建用户失败');</script>";
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="MasterkinG32.CoM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="description" content="Simple Register">
    <meta name="description" content="Simple Register">
    <title>Simple Register</title>
    <link rel="stylesheet" href="/css/register.css">

</head>
<body>
<div class="header">
    <h1>经典注册表单</h1>
</div>
<div class="w3-main">
    <!-- Main -->
    <div class="about-bottom main-agile book-form">
        <div class="alert-close"> </div>
        <h2 class="tittle">注册</h2>
        <form action="" method="post">
            <div class="form-date-w3-agileits">
                <label> 用户名 </label>
                <input type="text" name="name" placeholder="请输入用户名" required="">
                <label> 邮件 </label>
                <input type="email" name="email" placeholder="请输入邮件" required="">
                <label> 密码 </label>
                <input type="password" name="password" placeholder="请输入密码" required="">
                <label> 确认密码 </label>
                <input type="password" name="password" placeholder="请输入确认密码" required="">
            </div>
            <div class="make wow shake">
                <input type="submit" value="注册">
            </div>
        </form>
    </div>
    <!-- //Main -->
</div>
<!-- footer -->
<div class="footer-w3l">
    <p>&copy; 2022 Classy Register Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
</div>
<!-- //footer -->
<!-- js-scripts-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script>$(document).ready(function(c) {
        $('.alert-close').on('click', function(c){
            $('.main-agile').fadeOut('slow', function(c){
                $('.main-agile').remove();
            });
        });
    });
</script>


