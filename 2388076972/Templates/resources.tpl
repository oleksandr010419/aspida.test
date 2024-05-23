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
$q1 = "SELECT `uid`,`infa` FROM palevo WHERE `type` = '96' GROUP BY `uid`";
$work_arr = $database->query($q1);
?>
<body>
<table id="profile">
    <thead>
    <tr><th colspan="3">List showing number of merchants sent TO specific players.</th></tr>
    <td class="b">Target</td>
    <td class="b">Details</td>
    </thead>
    <tbody>
    <div align="center">
    </div>
	<?php 
	foreach($work_arr as $work_inf)
	{
		$current_user = $database->row("SELECT `id`,`username`,`access` FROM users WHERE id = ".$work_inf['uid']);
		if(empty($current_user))continue;
		$new_infa = "%biderID:" . $work_inf['uid']."%";
		$not_infa = "%ownerID:" . $work_inf['uid']."%";
		$q2 = "SELECT `uid`,`infa` FROM palevo WHERE `infa` LIKE '".$new_infa."' AND `uid`<>".$work_inf['uid']." AND type=97";
		$inf_arr = $database->query($q2);
		
		$res_array = array();
		foreach($inf_arr as $resources){
			if(!isset($res_array[$resources['uid']])){
				$res_array[$resources['uid']] = array("wood"=>0,"iron"=>0,"clay"=>0,"crop"=>0,"count"=>0);
			}
			$details = explode(',',$resources['infa']);
			$res_array[$resources['uid']]["wood"] += explode(':',$details[2])[1];
			$res_array[$resources['uid']]["clay"] += explode(':',$details[3])[1];
			$res_array[$resources['uid']]["iron"] += explode(':',$details[4])[1];
			$res_array[$resources['uid']]["crop"] += explode(':',$details[5])[1];
			$res_array[$resources['uid']]["count"]++;
			$res_array[$resources['uid']]["user"]=$database->row("SELECT `id`,`username`,`access` FROM users WHERE id = ".$resources['uid']);
			if(empty($res_array[$resources['uid']]["user"])){
				unset($res_array[$resources['uid']]);
			}	
		}
			//print_r($res_array);
		if(count($res_array)==0)continue;
		?>
		<tr >
			<td >
				<div align="center">
					<?php
					echo '<span class="ajax_ban" style="cursor:pointer;color:'.(($current_user['access']==0)?'red"':'green').'" data-uid="'.$current_user['id'].'" data-href="?p=player&uid='.$current_user['id'].'">'.$current_user['username'].'</span>';
					?>
				</div></td>
			<td >
				<div align="center">
							<table>
					<?php
						foreach($res_array as $uid=>$resources){
							$user = $resources['user'];
							?><tr>
							<?php 
							echo '<td><span class="ajax_ban" style="cursor:pointer;color:'.(($user['access']==0)?'red"':'green').'" data-uid="'.$user['id'].'" data-href="?p=player&uid='.$user['id'].'">'.$user['username'].'</span></td>';
							echo '<td>Wood received: '.	$resources['wood'].'</td>';
							echo '<td>Iron received: '.	$resources['iron'].'</td>';
							echo '<td>Clay received: '.	$resources['clay'].'</td>';
							echo '<td>Crop received: '.	$resources['crop'].'</td>';
							echo '<td>Overall transports: '.	$resources['count'].'</td>';
							
							?>
							</tr>
							<?php 
						}
					?></table>
				</div>
			</td>
		</tr>
		<?php
	}
	?>
    <div align="center">
	</tbody>
</table>
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