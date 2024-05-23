<!DOCTYPE html>
<html class="onloader">
<head>
	<title>Payment for chosen product</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">html,body{margin:0;padding:0;background-color:#e9e9e9;font-size:14px;font-family:Verdana,Arial,Helvetica,sans-serif;color:#333;direction:ltr}.small{font-size:12px;font-weight:normal}a{text-decoration:none}a:link{color:#7da519}a:visited{color:#7da519}a:hover{color:#557d1e}a:active{color:#557d1e}table.containertable{margin:35px auto 0 auto;text-align:center}td.container,div.messagebox{background-color:#fff;border:2px solid #d6d6d6}td.container{padding:4px;text-align:center}#buttonSealDiv{padding:4px;text-align:center}table.messagetable{text-align:left}td.subtitle{text-align:center;padding-bottom:4px;font-size:14px;font-weight:bold;border-bottom:2px solid #d6d6d6}td.logo{padding-top:5px;width:130px;vertical-align:top}td.message{width:470px;padding:6px 6px 6px 12px;vertical-align:middle;text-align:left}td.closewindow{padding:2px;text-align:right;font-size:12px;font-weight:bold}div.messagebox{position:relative;margin:75px auto 75px auto;padding:20px;width:300px;text-align:center;font-size:16px;font-weight:bold;white-space:nowrap}div.messageboxButton{margin:25px auto 5px auto;padding:20px 20px 10px 20px}div.buttonTop{position:relative;border-radius:5px 5px 0 0;background-color:#ccc;padding:2px;width:100%}div.buttonBottom{font-weight:normal;border-radius:0 0 5px 5px;background-color:#eaeaea;margin:0 0 20px 0}.button{color:#FFF;width:100%;border:1px solid #36780f;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;font-family:arial,helvetica,sans-serif;padding:5px;text-shadow:-1px -1px 0 rgba(0,0,0,0.3);font-weight:bold;text-align:center;color:#fff;background-color:#62ae2a;background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#62ae2a),color-stop(100%,#a5da6e));background-image:-webkit-linear-gradient(top,#a5da6e,#62ae2a);background-image:-moz-linear-gradient(top,#a5da6e,#62ae2a);background-image:-ms-linear-gradient(top,#a5da6e,#62ae2a);background-image:-o-linear-gradient(top,#a5da6e,#62ae2a);background-image:linear-gradient(top,#a5da6e,#62ae2a);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#62AE2A,endColorstr=#A5DA6E)}span.defect_message{color:#C00}.units{font-size:smaller}</style>
</head>
<body>
	<noscript>
		Please enable JavaScript in your Browser to continue.
	</noscript>

	<div class="messagebox messageboxButton">
		<img src="img/payment/Aspida_Payment.png" alt="Aspida Servers">

		<div class="buttonTop">
			Your choosen product:
		</div>
		<div class="buttonTop buttonBottom">
			<?=$vars['package']['gold']?> Gold<br/>
			<span class="units">
				(Package <?=$vars['package']['name']?>)
			</span>
		</div>
		<div class="buttonTop">
			Your choosen provider:
			<br/>
		</div>
		<div class="buttonTop buttonBottom">
			<img src="img/provider/<?=$vars['checkout']['img']?>" alt="<?=$vars['checkout']['name']?>">
		</div>
		<div class="buttonTop">
			To pay:
		</div>
		<div class="buttonTop buttonBottom">
			<span class="bold">
				<?=$vars['package']['price']?> <?=$vars['package']['moneyUnit']?>
				<br/>
			</span>
			<span class="small">
				(final consumer price)
			</span>
		</div>

		<form action="<?=$vars['checkout']['payment_data']['post_url']?>" method="POST">
		    <button class="buttonBottom button" type="submit">Buy</button>
		    <input type="hidden" name="METHOD" value="preLoadProvider"/>
		    <input type="hidden" name="ORDER" value="<?=$vars['order']?>"/>
		</form>
	</div>
	<div id="container"></div>
</body>
</html>