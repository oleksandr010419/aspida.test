<?php
global $session;
include 'tab_header.php';
echo getHeader('extraPlus');
?>
<div class="contentBorder infoArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <a href="#"
           onclick="$$('.paymentWizardMenu').addClass('hide');$$('.buyGoldInfoStep').removeClass('active');$$('.buyGoldInfoStep#1').addClass('active');$$('.paymentWizardMenu#generalOptions').removeClass('hide');">
            <div
                class="buyGoldInfoStep active"
                id="1">
                <div
                    class="buyGoldInfoStepNumber">1
                </div>
                <div
                    class="buyGoldInfoStepLabel">General
                    :
                </div>
                <div
                    class="buyGoldInfoStepContent">General Options
                </div>
            </div>
        </a>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <div class="paymentPopupDialogWrapper">
			<?php include 'plus/general.php';?>
        </div>
	</div>
</div>
<?php include 'tab_info.php';
echo getTabs("extraPlus");?>		
<?php include 'tab_footer.php';?>