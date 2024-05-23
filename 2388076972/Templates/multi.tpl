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
//$q = "SELECT * FROM palevo WHERE `type` = '0' and `sit`= '0'";
$q1 = "SELECT `infa` FROM palevo WHERE `type` = '0' AND `sit` = '0' GROUP BY `infa` HAVING count(`uid`) > 1";
$q3="SELECT * FROM palevo WHERE `type` = '50' AND `sit` = '0' GROUP BY `infa` HAVING count(`uid`) > 1";
$q4="SELECT * FROM palevo WHERE `type` = '50' AND `infa`=''";
$ip_multis = $database->query($q1);
$session_multis = $database->query($q3);
$bot_multis = $database->query($q4);
?>
<body>
<table id="profile">
    <thead>
    <tr><th colspan="3">IP based - Multi Account Detect</th></tr>
    <td class="b">Player</td>
    <td class="b">IP</td>
    </thead>
    <tbody>
    <div align="center">
        <?php
        foreach($ip_multis as $work_inf)
        {
			$q2 = "SELECT `uid` FROM palevo WHERE `infa` = '".$work_inf['infa']."' AND `sit`='0' GROUP BY `uid`";
			$inf_arr = $database->query($q2);
			$output = "";
			if(count($inf_arr)>1)
			{
			unset($userdata);
			foreach($inf_arr as $work_use)
			{
			$userdata = $database->query("SELECT `id`,`username`,`access` FROM users WHERE id = ".$work_use['uid']);
			foreach ($userdata as $u) {
			$output = $output.'<span class="ajax_ban" style="cursor:pointer;color:'.(($u['access']==0)?'red"':'green').'" data-isbanned="'.(($u['access']==0)?'1"':'0').'" data-uid="'.$u['id'].'" data-href="?p=player&uid='.$u['id'].'">'.$u['username'].'</span> + '; }
			}
        ?>
    </div>
    <tr >
        <td >
            <div align="center">
                <?php
                echo $output;//$output = implode(' and ', $output);
                ?>
            </div></td>
        <td >
            <div align="center">
                <?php
                echo $work_inf['infa'];
                ?>
            </div></td>
    </tr>
    <div align="center">
        <?php
        }
        }
        echo '</tbody></table>';
		?>
		<table id="profile">
    <thead>
    <tr><th colspan="3">Browser based - Multi Account Detect v1</th></tr>
    <td class="b">Player</td>
    <td class="b">Browser Session ID</td>
    </thead>
    <tbody>
    <div align="center">
        <?php
        foreach($session_multis as $work_inf)
        {
			$q2 = "SELECT `uid` FROM palevo WHERE `infa` = '".$work_inf['infa']."' AND `sit`='0' GROUP BY `uid`";
			$inf_arr = $database->query($q2);
			$output = "";
			if(count($inf_arr)>1)
			{
			unset($userdata);
			foreach($inf_arr as $work_use)
			{
			$userdata = $database->query("SELECT `id`,`username`,`access` FROM users WHERE id = ".$work_use['uid']);
			foreach ($userdata as $u) {
			$output = $output.'<span class="ajax_ban" style="cursor:pointer;color:'.(($u['access']==0)?'red"':'green').'" data-isbanned="'.(($u['access']==0)?'1"':'0').'" data-uid="'.$u['id'].'" data-href="?p=player&uid='.$u['id'].'">'.$u['username'].'</span> + '; }
			}
        ?>
    </div>
    <tr >
        <td >
            <div align="center">
                <?php
                echo $output;
                ?>
            </div></td>
        <td >
            <div align="center">
                <?php
                echo $work_inf['infa'];
                ?>
            </div></td>
    </tr>
    <div align="center">
        <?php
        }
        }
        echo '</tbody></table>';?>
	
	<table id="profile">
    <thead>
    <tr><th colspan="3">Key based - Bot Detect v1</th></tr>
    <td class="b">Player</td>
    <td class="b">Browser Session ID</td>
    </thead>
    <tbody>
    <div align="center">
        <?php
        foreach($bot_multis as $work_inf)
        {
			$userdata = $database->row("SELECT `id`,`username`,`access` FROM users WHERE id = ".$work_inf['uid']);
			$output = $output.'<span class="ajax_ban" style="cursor:pointer;color:'.(($userdata['access']==0)?'red"':'green').'" data-isbanned="'.(($userdata['access']==0)?'1"':'0').'" data-uid="'.$userdata['id'].'" data-href="?p=player&uid='.$userdata['id'].'">'.$userdata['username'].'</span> + '; 
		?>
    </div>
    <tr >
        <td >
            <div align="center">
                <?php
                echo $output;
                ?>
            </div></td>
        <td >
            <div align="center">
                <?php
                echo $work_inf['browser'];
                ?>
            </div></td>
    </tr>
    <div align="center">
        <?php
        }
        echo '</tbody></table>';
?>
</div>
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