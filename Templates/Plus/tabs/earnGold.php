<?php include 'tab_header.php';
echo getHeader('earnGold');
?>
			<div class="contentBorder infoArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <h4>How can I invite players?</h4>

        <div class="howToDescription">
            If you invite players to open an account in Travian on this server, you can receive Gold as a reward. You can use this Gold to purchase a Plus Account or other Gold advantages.            <br/>
            <br/>
            To bring in new players, you can invite them by email or have them click on your REF link.            <br/>
            As soon as an invited player has reached <span class="amount">2</span> villages, you will receive <span class="goldReward"><img src="img/x.gif" class="gold" alt="Gold"> <span class="amount">20.</span></span>        </div>
        <div class="footer"><a class="showEarnGoldPage"
                               href="#">back to overview</a>
        </div>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <div class="earnGoldPage earnGoldOverview" style="display: block;">
            <h4>Choose an option to earn gold</h4>
                            <div class="boxes roundedContentBox red">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf"><h5>Invitation is closed</h5>
                        <div class="boxContent">Server is closed for invitations.</div>
                        <div class="footer"></div>	</div>
                </div>
                    </div>
                <script type="text/javascript">
            Travian.Translation.add(
                {
                    'earnGoldContentMailSendReceiverCount': 'Recipient [RECEIVER_COUNT]:'
                });
        </script>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    window.addEvent('domready', function () {
        Travian.Translation.add(
            {
                'paymentWizard.infoButtonLabel': 'Travian Answers'
            });
    });
</script>		
		
<?php include 'tab_info.php';
echo getTabs("earnGold");?>		
<?php include 'tab_footer.php';?>