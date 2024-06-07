<div id="goldSilver" class="currency">
	<i alt="<?php echo HEADER_GOLD; ?>" title="<?php echo HEADER_GOLD; ?>" class="goldCoin_medium"></i>
	<div id="ajaxReplaceableGoldAmount_2" class="ajaxReplaceableGoldAmount value">
		<?php echo $session->gold; ?>
	</div>
	<!-- <a href="hero_auction.php"> -->
		<i alt="<?php echo HEADER_SILVER; ?>" title="<?php echo HEADER_SILVER; ?>" class="silverCoin_medium"></i>
	<!-- </a> -->
	<div class="ajaxReplaceableSilverAmount value">
		<?php echo "$session->silver"; ?>
	</div>
</div>
<a href="#" accesskey="7" onclick="window.fireEvent('startPaymentWizard', {}); this.blur(); return false;" id="n7" class="shop"></a>



<script type="text/javascript">
	$$('#outOfGame li.logout a').addEvent('click', function () {
		Travian.WindowManager.getWindows().each(function ($dialog) {
			Travian.WindowManager.unregister($dialog);
		});
	});
</script>