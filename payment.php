<?php session_start();
error_reporting(0);
include("GameEngine/config.php");
header('Content-Type: text/html; charset=UTF-8');
$golds=array(100,250,800,1150,2500,4000,20,10);
$money=array(50,100,200,300,500,750,10,1);
$email = $_SESSION['email'];
$tarif=$_GET['tarif'];
switch($tarif){
    case "A": $gold=$golds[0];$m=$money[0];
        break;
    case "B": $gold=$golds[1];$m=$money[1];
        break;
    case "C": $gold=$golds[2];$m=$money[2];
        break;
    case "D": $gold=$golds[3];$m=$money[3];
        break;
    case "E": $gold=$golds[4];$m=$money[4];
        break;
    case "F": $gold=$golds[5];$m=$money[5];
        break;
    case "S": $gold=$golds[6];$m=$money[6];
        break;
    case "L": $gold=$golds[7];$m=$money[7];
        break;
    default: echo "Что-то пошло не так."; exit;
}
?>
<html>
<head>
<title></title>
</head>
<body>
<style>
body{
background:white;
}

.leftbox{
width:130px;
float:left;
padding:10px;
text-align:center;
margin-right:10px;
}
.content{
overflow:hidden;
}
.obvert{
border-radius:5px;
border:1px solid gold;
padding:4px;
}
a{
color:black;
text-decoration:none;
}
</style>
<div class="wrapp">
<center><h3>Шаг 2: выберите способ оплаты</h3></center>
<a href="https://unitpay.ru/pay/18941-10b5e?sum=<?=$m?>&account=<?=$_SESSION['email']?>|<?=SPEED?>&desc=Оплата Золота для Xtravian.ru Тариф <?=$tarif?>" target="_blank">
<div class="obvert">
	<div class="leftbox">
		<img style="margin-top:-50px;" src="img/payer.png"/><br/>Продолжительность: мгновенно <br/>
	</div>
	<div class="content">
		UnitPay - это удобный способ оплаты!В нем вы найдете основные платежные системы.<br/><br/>
		<img alt="UnitPay" src="https://unitpay.ru/images/f8ede98.png" height="50" width="150">
	</div>
</div>
</a>
    <?php /*
    <br /> <br /> <br /> <br />
    <a href="http://Brainianz.ru/buygold.php?key=<?=base64_encode("Arina;".$_SESSION['email'].";88;".$tarif.";Wolf")?>"  target="_blank">
        <div class="obvert">
            <div class="leftbox">
                <img style="margin-top:-50px;" src="img/payer.png"/><br/>Продолжительность: мгновенно <br/>
            </div>
            <div class="content">
                Payeer - это удобный способ для покупки золота! Содержит множество сторонних способов оплаты.<br/><br/>
                <img alt="Payeer" src="https://payeer.com/images/img/logo.png" height="50" width="150">
            </div>
        </div>
    </a>
 */?>
</div>
</body>
</html>