<h2>Player rewards</h2>
<br/>
<?php
$cfg = parse_ini_file(__DIR__.'/../../../scripts/config.ini', true)['prize'];
?>
<table>
		<tr><thead>
			<td colspan="2"><font face="verdana" color="Black" font size="3">Here you can see the prizes that you can win at the end of every round.</td>
		</thead>
		</tr>
		<tr><tbody>
			<td><img src="/img/winner.png" title="Winner of the Game" style="width: 70px;"/></td>
			<td><font face="verdana" color="Black" font size="2">1st player that he build the world wonder to level <b>100</b> will receive <b><?=$cfg['ww_winner_gold']?></b>&nbsp;<img src="img/x.gif" class="gold" title="Gold"/></td>
		<tr>
			<td><img src="/img/attacker.png" title="1st Attacker" style="width: 70px;"/></td>
			<td><font face="verdana" color="Black" font size="2">For the 1st place attecker the prize will be <b><?=$cfg['attacker_gold']?></b>&nbsp;<img src="img/x.gif" class="gold" title="Gold"/></td>
		</tr>
		<tr>
			<td><img src="/img/defender.png" title="1st Defender" style="width: 70px;"/></td>
			<td><font face="verdana" color="Black" font size="2">For the 1st place defender the prize will be <b><?=$cfg['defender_gold']?></b>&nbsp;<img src="img/x.gif" class="gold" title="Gold"/></td>
		</tr>
		<tr>
			<td><img src="/img/pop.png" title="1st Population" style="width: 70px;"/></td>
			<td><font face="verdana" color="Black" font size="2">For the player with the bigger account population the prize will be <b><?=$cfg['village_gold']?></b>&nbsp;<img src="img/x.gif" class="gold" title="Gold"/></td>
		</tr>
		<tr>
			<td><img src="/img/alliance.png" title="1st Alliance Players" style="width: 70px;"/></td>
			<td><font face="verdana" color="Black" font size="2">All players that they participated in the winner's alliance will receive <b><?=$cfg['alliance_gold']?></b>&nbsp;<img src="img/x.gif" class="gold" title="Gold"/></td>
		</tr>
		<tr>
			<td colspan="2"><font face="verdana" color="grey" font size="1">You will receive the coupon with the prize after the end of the round by email. All the coupons will expiring after 90 days from the day you received the email.</td>
		</tbody>
		</tr>
</table>