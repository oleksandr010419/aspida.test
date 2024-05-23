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
$q1 = "SELECT `uid`,`infa` FROM palevo WHERE (`type` = '76' OR `type`='77') GROUP BY `uid`";
$work_arr = $database->query($q1);
?>
<body>
<table id="profile">
    <thead>
    <tr>
    	<th colspan="3">List showing suspicious messages containing url links in them.</th>
    </tr>
    <tr>
    	<td class="b">Sender</td>
   		<td colspan="2" class="b">Details</td>
    </tr>
    </thead>
    <tbody>
	<?php 
	foreach($work_arr as $work_inf)
	{
		$current_user = $database->row("SELECT `id`,`username`,`access` FROM users WHERE id = ".$work_inf['uid']);
		if(empty($current_user))continue;
		$q2 = "SELECT `uid`,`infa`,`type` FROM palevo WHERE (`type` = '76' OR `type`='77') AND `uid`=".$work_inf['uid']." ORDER BY `uid`";
		$inf_arr = $database->query($q2);
		
		$res_array = array();
		foreach($inf_arr as $resources){
			$details = explode(',',$resources['infa']);
			$target_user = explode(':',$details[1])[1];
			/*if(!isset($res_array[$details[1]])){
				$res_array[$details[1]] = array("messages"=>array(),"count"=>0);
			}*/
			$res_array[$target_user]["messages"][] = array("message"=>$details[0],"type"=>$resources['type']);
			$res_array[$target_user]["count"]++;
			$res_array[$target_user]["user"]=$database->row("SELECT `id`,`username`,`access` FROM users WHERE id = ".$target_user);
		
		}
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
							echo '<td>'.((!empty($user))?$user['username']:"-").'</td>';
							echo '<td>';
							foreach($resources["messages"] as $message){
								if($message['type']==76)
								echo '<font style="color:red">';
								echo $message["message"];
								if($message['type']==76)
								echo '</font>';
								echo '<hr>';
							}
							echo '</br></td>';
							
							?>
							</tr>
							<?php 
						}
					?>
					</table>
				</div>
			</td>
			<td><?='Overall suspicious messages: '.	$resources['count'];?></td>
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
			$.post("admin.php",{action:"delBan",uid:handle.data("uid"),reason:"Spam",end:""}).done(function() {
			  $('span[data-uid="'+handle.data('uid')+'"]').css("color","green").data('isbanned',0);
			});
			}else{
			$.post("admin.php",{action:"addBan",uid:handle.data("uid"),reason:"Spam",end:""}).done(function() {
			  $('span[data-uid="'+handle.data('uid')+'"]').css("color","red").data('isbanned',1);
			  $.post("admin.php",{action:"purgeMessages",uid:handle.data("uid")});
			});
			}
		});
	});
</script>