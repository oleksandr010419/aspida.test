<?php

global $session,$village,$u31,$u32,$u33,$u34,$u35,$u36,$u37,$u38,$u39,$u40;
$tot31=($u31['di'] + $u31['dc']);
$tot32=($u32['di'] + $u32['dc']);
$tot33=($u33['di'] + $u33['dc']);
$tot34=($u34['di'] + $u34['dc']);
$tot35=($u35['di'] + $u35['dc']);
$tot36=($u36['di'] + $u36['dc']);
$tot37=($u37['di'] + $u37['dc']);
$tot38=($u38['di'] + $u38['dc']);
$tot39=($u39['di'] + $u39['dc']);
$tot40=($u40['di'] + $u40['dc']);

//times number (elephant/nature)
$times31=($tot40 / $tot31);
$times32=($tot40 / $tot32);
$times33=($tot40 / $tot33);
$times34=($tot40 / $tot34);
$times35=($tot40 / $tot35);
$times36=($tot40 / $tot36);
$times37=($tot40 / $tot37);
$times38=($tot40 / $tot38);
$times39=($tot40 / $tot39);
$times40=($tot40 / $tot40);

//number of troops * game speed
$troop31=(($times31 * SPEED) / 2);
$troop32=(($times32 * SPEED) / 2);
$troop33=(($times33 * SPEED) / 2);
$troop34=(($times34 * SPEED) / 2);
$troop35=(($times35 * SPEED) / 2);
$troop36=(($times36 * SPEED) / 2);
$troop37=(($times37 * SPEED) / 2);
$troop38=(($times38 * SPEED) / 2);
$troop39=(($times39 * SPEED) / 2);
$troop40=(($times40 * SPEED) / 2);

$troop41=(($times31 * SPEED) / 1);
$troop42=(($times32 * SPEED) / 1);
$troop43=(($times33 * SPEED) / 1);
$troop44=(($times34 * SPEED) / 1);
$troop45=(($times35 * SPEED) / 1);
$troop46=(($times36 * SPEED) / 1);
$troop47=(($times37 * SPEED) / 1);
$troop48=(($times38 * SPEED) / 1);
$troop49=(($times39 * SPEED) / 1);
$troop50=(($times40 * SPEED) / 1);

$troop51=(($times31 * SPEED) * 2);
$troop52=(($times32 * SPEED) * 2);
$troop53=(($times33 * SPEED) * 2);
$troop54=(($times34 * SPEED) * 2);
$troop55=(($times35 * SPEED) * 2);
$troop56=(($times36 * SPEED) * 2);
$troop57=(($times37 * SPEED) * 2);
$troop58=(($times38 * SPEED) * 2);
$troop59=(($times39 * SPEED) * 2);
$troop60=(($times40 * SPEED) * 2);

$troop61=(($times31 * SPEED) * 4);
$troop62=(($times32 * SPEED) * 4);
$troop63=(($times33 * SPEED) * 4);
$troop64=(($times34 * SPEED) * 4);
$troop65=(($times35 * SPEED) * 4);
$troop66=(($times36 * SPEED) * 4);
$troop67=(($times37 * SPEED) * 4);
$troop68=(($times38 * SPEED) * 4);
$troop69=(($times39 * SPEED) * 4);
$troop70=(($times40 * SPEED) * 4);

$troop71=(($times31 * SPEED) * 8);
$troop72=(($times32 * SPEED) * 8);
$troop73=(($times33 * SPEED) * 8);
$troop74=(($times34 * SPEED) * 8);
$troop75=(($times35 * SPEED) * 8);
$troop76=(($times36 * SPEED) * 8);
$troop77=(($times37 * SPEED) * 8);
$troop78=(($times38 * SPEED) * 8);
$troop79=(($times39 * SPEED) * 8);
$troop80=(($times40 * SPEED) * 8);

$troop81=(($times31 * SPEED) * 16);
$troop82=(($times32 * SPEED) * 16);
$troop83=(($times33 * SPEED) * 16);
$troop84=(($times34 * SPEED) * 16);
$troop85=(($times35 * SPEED) * 16);
$troop86=(($times36 * SPEED) * 16);
$troop87=(($times37 * SPEED) * 16);
$troop88=(($times38 * SPEED) * 16);
$troop89=(($times39 * SPEED) * 16);
$troop90=(($times40 * SPEED) * 16);


?>
<div class="paymentWizardMenu hide" id="buyAnimal">
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal0">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop31),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop32),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop33),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop34),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop35),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop36),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop37),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop38),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop39),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop40),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
				<?php
				if ($session->gold >= 100) {
					echo  getIDButton("buttonra6pegus",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttonra6pegus'))
                        {
							$('buttonra6pegus').outerHTML = $('buttonra6pegus').outerHTML;
                            $('buttonra6pegus').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "71", "context": "paymentWizard"}, "title": "Buy", "coins": 100, "id": "buttonra6pegus"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal1">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop41),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop42),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop43),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop44),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop45),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop46),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop47),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop48),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop49),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop50),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
                <?php
				if ($session->gold >= 200) {
					echo  getIDButton("buttonhesef3ad",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttonhesef3ad'))
                        {
							$('buttonhesef3ad').outerHTML = $('buttonhesef3ad').outerHTML;
                            $('buttonhesef3ad').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "72", "context": "paymentWizard"}, "title": "Buy", "coins": 200, "id": "buttonhesef3ad"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal2">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop51),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop52),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop53),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop54),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop55),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop56),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop57),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop58),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop59),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop60),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
                <?php
				if ($session->gold >= 400) {
					echo  getIDButton("buttoncheda5ar",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttoncheda5ar'))
                        {
							$('buttoncheda5ar').outerHTML = $('buttoncheda5ar').outerHTML;
                            $('buttoncheda5ar').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "73", "context": "paymentWizard"}, "title": "Buy", "coins": 400, "id": "buttoncheda5ar"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal3">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop61),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop62),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop63),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop64),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop65),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop66),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop67),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop68),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop69),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop70),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
                <?php
				if ($session->gold >= 800) {
					echo  getIDButton("buttons3edrusp",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">800</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttons3edrusp'))
                        {
							$('buttons3edrusp').outerHTML = $('buttons3edrusp').outerHTML;
                            $('buttons3edrusp').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "74", "context": "paymentWizard"}, "title": "Buy", "coins": 800, "id": "buttons3edrusp"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal4">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop71),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop72),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop73),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop74),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop75),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop76),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop77),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop78),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop79),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop80),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
                <?php
				if ($session->gold >= 1600) {
					echo  getIDButton("buttonwr8peste",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1600</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttonwr8peste'))
                        {
							$('buttonwr8peste').outerHTML = $('buttonwr8peste').outerHTML;
                            $('buttonwr8peste').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "75", "context": "paymentWizard"}, "title": "Buy", "coins": 1600, "id": "buttonwr8peste"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
    <div class="feature featureBooking " style="height: 58px">
        <input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAnimal5">
        <div class="featureContent">
            <table style="width: 80%; border: 0">
                <tbody>
                    <tr style="border: 0;">
                        <td style="border: 0; height: 20%;">
                            <img class="unit u31" src="img/x.gif"> <?=number_format(round($troop81),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u32" src="img/x.gif"> <?=number_format(round($troop82),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u33" src="img/x.gif"> <?=number_format(round($troop83),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u34" src="img/x.gif"> <?=number_format(round($troop84),0,'.','.')?></td>
                        <td style="border: 0; height: 20%;">
                            <img class="unit u35" src="img/x.gif"> <?=number_format(round($troop85),0,'.','.')?></td>
                    </tr>
                    <tr style="border: 0;">
                        <td style="border: 0">
                            <img class="unit u36" src="img/x.gif"> <?=number_format(round($troop86),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u37" src="img/x.gif"> <?=number_format(round($troop87),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u38" src="img/x.gif"> <?=number_format(round($troop88),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u39" src="img/x.gif"> <?=number_format(round($troop89),0,'.','.')?></td>
                        <td style="border: 0">
                            <img class="unit u40" src="img/x.gif"> <?=number_format(round($troop90),0,'.','.')?></td>
                    </tr>
                </tbody>
            </table>
            <div class="featureButton">
                <?php
				if ($session->gold >= 3200) {
					echo  getIDButton("buttonp4achute",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">3200</span>',false,"gold prosButton");
				} else {
					echo getButton("Low gold", '', true);
				}
				?>
                <script type="text/javascript">
                    window.addEvent('domready', function ()
                    {
                        if ($('buttonp4achute'))
                        {
							$('buttonp4achute').outerHTML = $('buttonp4achute').outerHTML;
                            $('buttonp4achute').addEvent('click', function ()
                            {
                                window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "76", "context": "paymentWizard"}, "title": "Buy", "coins": 3200, "id": "buttonp4achute"}]);
                            });
                        }
                    });
                </script>
            </div>
            <div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Time to process: <span class="bold">1</span>  min(s)
            </div>
        </div>
    </div>
</div>