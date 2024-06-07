<?php
$dorf1 = $dorf2 = 'inactive';
${'dorf'.$session->link}='active';
?>

<div id="navigation">
	<a id="n1" class="village resourceView <?php echo $dorf1; ?>" href="/dorf1.php" accesskey="1" title="<?php echo HEADER_DORF1; ?>||"></a>
	<a id="n2" class="village buildingView <?php echo $dorf2; ?>" href="/dorf2.php" accesskey="2" title="<?php echo HEADER_DORF2; ?>||"></a>
	<a id="n3" class="map" href="/karte.php" accesskey="3" title="<?php echo HEADER_MAP; ?>||"></a>
	<a id="n4" class="statistics" href="/statistiken.php" accesskey="4" title="<?php echo HEADER_STATS; ?>||"></a>
	<a id="n5" class="reports" href="/berichte.php" accesskey="5"
		title="<?php echo HEADER_NOTICES; ?>|| <?=newrpt?><?php echo " ".$session->unread['notice'];  ?>">
		<?php
	if($session->unread['notice'] !=0){
		$not = $session->unread['notice'] >= 100 ? "100+" : $session->unread['notice'];
		echo "<div class=\"speechBubbleContainer \">
		<div class=\"speechBubbleBackground\">
			<div class=\"start\">
				<div class=\"end\">
					<div class=\"middle\"></div>
				</div>
			</div>
		</div>
		<div class=\"speechBubbleContent\">".$not."</div>
	</div>";
	}
	?>
	</a>
	
	<a id="n6" class="messages" href="/nachrichten.php" accesskey="6"
		title="<?php echo HEADER_MESSAGES; ?>|| <?=newmsg?><?php echo " ".$session->unread['mes'];  ?>">
		<?php
	if($session->unread['mes'] !=0) {
		$mes = $session->unread['mes'] >= 100 ? "100+" : $session->unread['mes'];
		echo "
<div class=\"speechBubbleContainer \">
		<div class=\"speechBubbleBackground\">
			<div class=\"start\">
				<div class=\"end\">
					<div class=\"middle\"></div>
				</div>
			</div>
		</div>
		<div class=\"speechBubbleContent\">".$mes."</div>
	</div>";
	}
	?>
	</a>
</div>


<?php
include("Plus/modal_plus.php");
?>

<script type="text/javascript">
	window.addEvent('domready', function () {
		Travian.Game.Layout.goldButtonAnimation();
	});
</script>