<?php

$id = $_GET['uid'];
if(isset($id))
{
	include("../GameEngine/Ranking.php");
	$varmedal = $database->getProfileMedal($id);
	$user = $database->getUserArray($id,1);
	$varray = $database->getProfileVillages($id);
	$refreshicon  = "<img src=\"data:image/png;base64,
	iVBORw0KGgoAAAANSUhEUgAAAAkAAAAKCAIAAADpZ+PpAAAAAXNSR0IArs4c6QAAAARnQU1BAACx
	jwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAEQSURBVChTY/gPBkevHfRrtjMsU9bJ05+5eylE
	kAGI117fKFsqYzhTNeSQY8xhP8vJJmVrK3eeP8Bw58kt03rTkHnRxdvrnKd4m83SCTtsaLZI1K7H
	mGH2xpnHLh+GGPL7/7/S1dVKU2Usd6roTZBh+Pj3M0QCCL78+Fw6v1ooR1myWU2zzpjBb2Ko8xwf
	91l+gRNDLzw6f+nepcsPrl14cPXW8wcMWqVaEYdtPdZYubUHww0AMs5cusygU68UtVUr87CPWbdd
	9Ly83TcO7Lq2I7ozoXfZTAalCjWZemnlaYo2u0wVFkoJdwoyZDOZNDi//vqRwbkjac+dC827p2h3
	Gyh3S6m0a0Qszrnz6RnQWAAxV5tT/VAiNQAAAABJRU5ErkJggg==\">";
	if($user)
	{
		$totalpop = 0;
		foreach($varray as $vil)
		{
			$totalpop += $vil['pop'];
		}
		include('search2.tpl');
		echo "<br />";
		$deletion = $user['deleting'];
		if($deletion>time())
		{
			include("playerdeletion.tpl");
		}
		include("playerinfo.tpl");
		if($_SESSION['access'] == 9){ include("playeradditionalinfo.tpl");}
		echo "<br />";
		include ("villages.tpl"); ?>
		<div style="float: left;">
			<?php
				include ('punish.tpl');
			?>
		</div>
		<div style="float: right;">
			<?php
			if($_SESSION['access'] == ADMIN)
								{	include ('add_village.tpl'); }
			?>
		</div>
		<?php include("gold_log.tpl");
	}
	else
	{
		include("404.tpl");
	}
}else{
$result = $admin->search_player($_POST['s']);
?>
<table id="member">
  <thead>
    <tr>
        <th class="dtbl"><a href="">1 «</a></th><th>Found player (<?php echo count($result);?>)</th><th class="dtbl"><a href="">» 100</a></th>
    </tr>
  </thead> 

</table>
<table id="profile">    
    <tr>
		<td class="b">Rank</td>
        <td class="b">UID</td>
        <td class="b">Player</td>
        <td class="b">Villages</td>
        <td class="b">Pop</td>
		<td class="b"><img src="../img/admin/gold.gif" class="gold" alt="Gold" title="gold"/>Gold</td>
    </tr>
<?php      
if($result){  
for ($i = 0; $i <= count($result)-1; $i++) {    
$totalpop=0;/*
$varray = $database->getProfileVillages($result[$i]["id"]);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}*/
echo '
    <tr>
		<td>'.($i+1).'</td>
        <td>'.$result[$i]["id"].'</td>
        <td><a href="?p=player&uid='.$result[$i]["id"].'">'.$result[$i]["username"].'</a></td>
        <td>'.$result[$i]["tv"].'</td>
        <td>'.$result[$i]["tp"].'</td>
		<td><img src="../img/admin/gold.gif" class="gold" alt="Gold" title="This user has: '.$result[$i]['gold'].' gold"/>&nbsp;'.$result[$i]["gold"].'</td>
    </tr>  
'; 
}
}
else{  
echo '
    <tr>
        <td colspan="4">No results</td>  
    </tr>  
';
}
?>    
  
</table>
<?php } ?>