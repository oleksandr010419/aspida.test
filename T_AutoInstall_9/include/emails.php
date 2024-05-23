<?php
include_once (dirname(__FILE__)."/../../GameEngine/config.php");
include_once (dirname(__FILE__)."/../../GameEngine/DB.php");
include_once (dirname(__FILE__)."/../../GameEngine/Database/db_MYSQL.php");
include_once (dirname(__FILE__)."/../../../scripts/bank_coupon/main.php");

function gatherUsers(){
	global $database;
	$users = $database->query("SELECT * FROM users where access=2 and id<>3");
	$users_to_add = array();
	$users_to_update = array();
	$update_query = "UPDATE user_emails SET username=";
	$add_query = "INSERT INTO user_emails (username,email,server_id) VALUES ";
	if (!empty($users)) {
		$emails = array();
		$get_users_to_update = "SELECT email FROM user_emails where server_id=".SPEED." AND ";
		$first = 1;
		foreach($users as $user){
			$emails[] = $user['email'];
			if(!$first){$get_users_to_update.= " OR ";}
			$get_users_to_update.=" email LIKE \"".$user['email']."\"";
			$first=0;
		}
		
		//Setup connection to main
		$mainDb = setupMainDatabase();
		if(!empty($emails)){
			$users_to_update = $mainDb->column($get_users_to_update);
			if(!empty($users_to_update)){
				$users_to_add = array_diff($emails,$users_to_update);				
			}else{
				$users_to_add = $emails;				
			}
		}
		$first = 1;
		$index=1;
		$add_data = array();
		foreach($users as $user){
			if(!empty($users_to_update) && in_array($user['email'],$users_to_update)){	
				$p = array('id'=>$user['username'],"email"=>$user['email']);
				$mainDb->query($update_query."':id' WHERE server_id='".SPEED."' AND username<> \":id\" AND email=\":email\"",$p);//always use lates user name								
				echo "Trying to update users that need to be updated";
			}else if(!empty($users_to_add) && in_array($user['email'],$users_to_add)){
				if(!$first){$add_query.= ",";}
				
				$add_data['id'.$index] = $user['username'];
				$add_data['email'.$index] = $user['email'];
				
				$add_query.= "(:id".$index.",:email".$index.",\"".SPEED."\")";
				$first=0;
				$index++;
			}
		}
		if(!$first){
			$add_query.=';';
			$mainDb->query($add_query,$add_data);		
			echo "Added users...";
		}else{
			echo "No new users to add";
		}
	}
	else{
		echo "Nothing to do";
	}
}

function notifyUsers(){
	$mainDb = setupMainDatabase();
	$get_users_to_notify = $mainDb->query("SELECT * FROM user_emails where server_id=".SPEED);
	if(!empty($get_users_to_notify)){
		foreach($get_users_to_notify as $user){
			$coupon = "";
			if($user['initial_gold']!=0){
				$bank = setupBank($user['initial_gold']);
				$coupon = $bank->createCoupon($user['email'],$user['initial_gold']);
			}
			createMail(SPEED,$user['username'],$user['email'],$user['initial_gold'],$coupon);
		}		
	}
}

function createMail($server, $username, $email, $gold, $key) {
	$subject = 'AspidaNETWORK server start reminder';

	$headers  = "From: no-reply@aspidanetwork.com\r\n";
	$headers .= "Reply-To: no-reply@aspidanetwork.com\r\n";
	$headers .= "CC: ".$email."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$message = '<div style="margin:0;padding:0;background-color:#96c46c;font-family:Arial,Helvetica,sans-serif">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td>
									<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="padding:0" align="center">
												<img src="http://aspidanetwork.com/img/mail/headerX.jpg" alt="Creating Email Magic" style="display:block" class="CToWUd a6T" tabindex="0">
											</td>
										</tr>
										<tr>
											<td style="padding:40px 30px 40px 30px" bgcolor="#ffffff">
												<b> Hello</b>,
												<br>
												<br>
												<br>
												Your time has come!
												<b>Today we are launching a new <a href="http://x'.$server.'.aspidanetwork.com/register" style="color:#f88c1f" title="Travian" target="_blank"> server</a> for Travian</b>. Ascend into the pantheon of Travian’s strongest and bravest warriors!
												<br>
												<br>
												<div align="center">
													<a href="http://x'.$server.'.aspidanetwork.com/register" title="Play now" target="_blank">
														<img alt="Play now" src="http://aspidanetwork.com/img/mail/Play_Now_Button_x120_rot_EN.jpg" style="border-width:0px;border-style:solid" title="Play now" height="47" width="120" class="CToWUd"></a>
												</div>
												<br>
												The struggle for artifacts and legendary wonders of the world is renewed.
												<br>
												<br>
												<b><a href="http://x'.$server.'.aspidanetwork.com/register" style="color:#f88c1f" title="Travian" target="_blank">Begin a new battle now</a></b> and join a powerful alliance. Don’t lose any time!<br>
												<br>Become the strongest player of Travian!<br><br><b>Your Aspida Team<br><br><br><br></b>
											</td>
										</tr>';
		if($gold!=0){
			$message.='					<tr>
											<td style="padding:40px 30px 40px 30px" bgcolor="#ffffff">
												<b> Additionaly</b>,as our supporter You`ll recieve free gold['.$gold.'] coupon.
												<br>
												To claim it just visit bank and use this['.$key.'] coupon code.
											</td>
										</tr>';
		}
		$message.='						<tr>
											<td style="padding:30px 30px 30px 30px" bgcolor="#666666">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td style="color:#fff" width="75%">
															® AspidaNetwork<br>
														</td>
														<td style="color:#fff">
															<a href="http://aspidanetwork.com" target="_blank">http://aspidanetwork.com</a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody>
					</table>
				<div class="yj6qo"></div>
				<div class="adL"></div>
			</div>';
	mail($email, $subject, $message, $headers);
}
	

function setupMainDatabase(){
	$config = parse_ini_file(__DIR__.'/../../../scripts/config.ini', true);
	$mainServer = new DB();
	$mainServer->NewConnect($config['database']['base'],$config['database']['host'], $config['database']['user'], $config['database']['pass']);
	return $mainServer;
}
function setupBank($gold=0){
	$config = parse_ini_file(__DIR__.'/../../../scripts/config.ini', true);
	$bank = new Bank($config['database']['host'],$config['database']['user'], $config['database']['pass'],$config['database']['base'],SPEED,$gold,time());
	return $bank;
}
?>