<?php
session_start();

require_once(__DIR__."/../GameEngine/Data/buidata.php");
require_once(__DIR__."/../GameEngine/config.php");
require_once(__DIR__."/../GameEngine/Database.php");
require_once(__DIR__."/../GameEngine/Admin/database.php");
require_once(__DIR__."/../GameEngine/Lang/en.php");

class timeFormatGenerator
{
	public function getTimeFormat($time)
	{
		$min = 0;
		$hr = 0;
		$days = 0;
		while ($time >= 60): $time -= 60; $min += 1; endwhile;
		while ($min  >= 60): $min  -= 60; $hr  += 1; endwhile;
		while ($hr   >= 24): $hr   -= 24; $days +=1; endwhile;
		if ($min < 10)
		{
			$min = "0".$min;
		}
		if($time < 10)
		{
			$time = "0".$time;
		}
		return $days ." day ".$hr."h ".$min."m ".$time."s";
	}
};
$timeformat = new timeFormatGenerator;

?>
<!DOCTYPE html>
<html>
	<head>
		<link REL="shortcut icon" HREF="../favicon.ico"/>
		<title>Admin Panel</title>
		<link rel=stylesheet type="text/css" href="../img/admin/admin.css">
		<link rel=stylesheet type="text/css" href="../img/admin/acp.css">
	</head>
	<body>
		<script language="javascript">
			function aktiv() {this.srcElement.className='fl1'; }
			function inaktiv() {event.srcElement.className='fl2'; }

			function del(e,id){
			if(e == 'did'){ var conf = confirm('Dou you really want delete village id '+id+'?'); }
			if(e == 'unban'){ var conf = confirm('Dou you really want unban player '+id+'?'); }
			if(e == 'stopDel'){ var conf = confirm('Dou you really want stop deleting user '+id+'?'); }
			if(conf){return true;}else{return false;}
			}
		</script>
		<script type="text/javascript">
			function showStuff(id) {
				document.getElementById(id).style.display = 'block';
			}
			function hideStuff(id) {
				document.getElementById(id).style.display = 'none';
			}
		</script>
		<div id="ltop1">

	</div>
			<div id="lmidall">
				<div id="lmidlc">
					<div id="lleft" style="width: 350px;">

						<table id="navi_table" cellspacing="0" cellpadding="0" style="width: 350px; background:none;">
							<tr>
								<td class="menu">
									<?php
										if($funct->CheckLogin())
										{?>
											<?php
											if($_SESSION['access'] == ADMIN)
											{ ?> <p style="text-align:left">
												<a href="/2388076972/admin.php">Admin panel home</a>
												<a href="/">Return to the server homepage</a>
												<a href="?action=logout">Logout</a>
												</br>
												<a href="#"><b>Information about the server</b></a>
												<a href="?p=config">Server Informations</a>
												<a href="?p=server_info">Server Statistics</a>
												<br />	
												<a href="#"><b>Information about the players</b></a>
												<a href="?p=player">Players</a>
												<a href="?p=map">Map</a>
												<a href="?p=spam">Spam</a>
												<a href="?p=results_alliances">Alliances</a>
												<a href="?p=results_villages">Villages</a>
												<a href="?p=online">Online players</a>
												<a href="?p=notregistered">No Activated Players</a>
												<a href="?p=results_email">Player emails</a>
												<a href="?p=inactives">Inactive accounts</a>
												<a href="?p=multi">Multi Accounts</a>
												<a href="?p=resources">Resource movements</a>
												<a href="?p=silver">Silver transactions</a>
												<a href="?p=spam">Suspicious messages</a>
												<br />
												<a href="#"><b>Search</b></a>
												<a href="?p=search">Search for: Player, Villages, alliance, etc.</a>
												<a href="?p=message">Search for messages and reports</a>
												<br />
												<a href="#"><b>Action</b></a>
												<a href="?p=ban">Ban player</a>
												<a href="../massmessage.php">Send Message</a>
												<a href="?p=resetPlusBonus">Reset Everyone's Resource Bonuses</a>
												<a href="?p=maintenence">Maintenence</a>
												<br />
												<a href="#"><b>Gold oprions</b></a>
												<a href="?p=gold">Give gold to all</a>
												<a href="?p=usergold">Give Free gold to specific user</a>
												<a href="?p=zabiraemgold">Get Gold from player</a>

												<br />

												<br />
												<a href="#"><b>Issued by clicking !! (Natars & medals)</b></a>
                                                <a href="../WowSoHardTofInDandSuchNaTars.php?step=1">Artifacts</a>
												<a href="../WowSoHardTofInDandSuchNaTars.php?step=2">WW villages</a>
												<a href="../WowSoHardTofInDandSuchNaTars.php?step=3">Building plains</a>
                                                <a href="../medalescroneswolf.php">Give Medals</a>
												<br />
												<a href="#"><b>Admin:</b></a>
												<a href="?p=admin_log"><font color="Red"><b>Log adminn</font></b></a>
												<a href="?p=addUsers">Add fake users</a>
												<?php
											}

										}
									?>
								</td>
							</tr>
						</table>
					</div>
					<div id="lmid1">
						<div id="lmidlc">
							<?php
								if($funct->CheckLogin())
								{
									if($_POST or $_GET)
									{
										if($_GET['p'] and $_GET['p']!="search")
										{
											$filename = 'Templates/'.$_GET['p'].'.tpl';
											if(file_exists($filename))
											{
												include($filename);
											}
											else
											{
												include('Templates/404.tpl');
											}
										}
										else
										{
											include('Templates/search.tpl');
										}
										if($_POST['p'] and $_POST['s'])
										{
											$filename = 'Templates/results_'.$_POST['p'].'.tpl';
											if(file_exists($filename))
											{
												include($filename);
											}
											else
											{
												include('Templates/404.tpl');
											}
										}
									}
									else
									{
										include('Templates/home.tpl');
									}
								}
								else
								{
									include('Templates/login.tpl');
								}
							?>
						</div>
					</div>
				</div>
			<div id="lright1"></div>
			<div id="ce"></div>
		</div>
	</body>
</html>

