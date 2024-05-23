<?php function getHeader($class = ""){
	return '<div id="paymentWizardContainer">
				<div id="loader" class="loader hide"></div>
				<div id="paymentWizard" class="'.$class.'">
					<input class="paymentWizardAnswersLink hide" type="hidden" name="answersLink" value="">
					<div class="contentWrapper">';
}
?>
