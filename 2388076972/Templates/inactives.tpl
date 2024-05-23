<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
  <link REL="shortcut icon" HREF="favicon.ico"/>
	<title><?php if($_SESSION['access'] == ADMIN){ echo 'Admin Control Panel - TravianX'; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'Multihunter Control Panel - TravianX'; } ?></title>
	<link rel=stylesheet type="text/css" href="../img/admin/admin.css">
	<link rel=stylesheet type="text/css" href="../img/admin/acp.css">
	<link rel=stylesheet type="text/css" href="../img/../img.css">
	<script src="jquery.min.js" type="text/javascript"></script>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="imagetoolbar" content="no">
</head>
<?php if($_SESSION['access'] < 8) die("Access Denied: You are not Admin!"); ?>
<?php
$q1 = "SELECT * FROM users WHERE id>6 AND username NOT LIKE '%Farm%' AND (logtime<".(time()-(60*60*24*1))." OR logtime=0)";
$inactive_accounts = $database->query($q1);
?>
<body>
<table id="profile">
    <thead>
    <tr><th colspan="3">Accounts inactive for more than 24 hours</th></tr>
    <td class="b">Player</td>
    <td class="b">Inactivity</td>
    </thead>
    <tbody>
        <?php
        foreach($inactive_accounts as $user){?>
		<tr >
			<td >
				<div align="center">
					<?php
					echo '<span class="ajax_ban" style="cursor:pointer;color:'.(($user['access']==0)?'red"':'green').'" data-uid="'.$user['id'].'" data-href="?p=player&uid='.$user['id'].'">'.$user['username'].'</span>';
					?>
				</div></td>
			<td >
				<div align="center">
					<?php
					if($user['logtime']==0){
					echo 'never';
					}else{
					echo (time()-$user['logtime'])/(60*60*24);
					}
					?>
				</div></td>
		</tr> 
		<?php } ?>
        <?php
        echo '</tbody></table>';
?>
<script type="text/javascript">
	$(function() {
		$('.ajax_ban').on('click',function(){
			var handle = $(this);
			if($(this).data('isbanned')){
			$.post("admin.php",{action:"delBan",uid:handle.data("uid"),reason:"Multiaccount",end:""}).done(function() {
			  $('span[data-uid="'+handle.data('uid')+'"]').css("color","green").data('isbanned',0);
			});
			}else{
			$.post("admin.php",{action:"addBan",uid:handle.data("uid"),reason:"Multiaccount",end:""}).done(function() {
			  $('span[data-uid="'+handle.data('uid')+'"]').css("color","red").data('isbanned',1);
			});
			}
		});
	});
</script>