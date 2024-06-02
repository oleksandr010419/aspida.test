<br /><br />
<?php
if(isset($_GET['id']) && isset($_GET['q'])) {
	$id=$database->filterstringvalue($_GET['id']);
$act=$database->getActivateFieldByRef($id,"act2,username,email");
    if($act['act2']==$_GET['q']){
    $show='1';
    $naam=$act['username'];
    $email=$act['email'];

    }
}
if(isset($show)){
$_SESSION['username']=$naam;
header("first.php");

 }else{ ?>
	<div id="content" class="activation">
		<h1 class="titleInHeader"><?=activate0?></h1>
        <form name="activation" id="activation" method="post">
            <input type="hidden" name="ft" value="a5" />
            <table cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td colspan="3"><?=activate0?>	</td>
                </tr>

                <tr>
                    <th>
                        <?=activate1?>					</th>
                    <td class="spacer">&nbsp;</td>
                    <td class="activationCode">
                        <input class="text" type="text" name="id" maxlength="10" value="<?php if(isset($_GET['code'])){echo $_GET['code']; }?>"/>

                        <div class="error">
<?php if($_GET['e']==3){
        echo "<small>".ACTIV10."</small>";
    }?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="submit"></th>
                    <td class="spacer">&nbsp;</td>
                    <td class="submit">
                        <button type="submit" value="<?=activate2?>" id="ActivateButton" class="green button textButtonV1">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=activate2?></div>
                            </div>
                        </button>
                        <div class="clear"></div>
                    </td>
                </tr>
                </tbody></table>
        </form>

        <br /><br /><br /><br /><br /><br />
        <div class="greenbox noEmailReceived">
            <div class="greenbox-top"></div>
            <div class="greenbox-content">


                <div id="noEmailReceivedLink" class="switchButton noEmailReceivedLink" onclick="Travian.toggleSwitch($$('#noMailReceivedForm'),$$('#noEmailReceivedLink .roundArrow'));">

                    <img class="close roundArrow switchClosed " id="arrow"  src="img/x.gif">
                    <?=activate3?>
				</div>

                <div id="noMailReceivedForm" class="hide">
                    <form name="resendActivationEmail" id="resendActivationEmail" method="post">
                        <input type="hidden" name="ft" value="a3" />
                        <p><?=activate4?></p>
						<div id="showErrorsDivResendMail" class="error">
							
                        </div>




                        <table cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <th>
                                    <?=activate5?>		</th>
                                <td class="spacer">&nbsp;</td>
                                <td class="email">
                                    <input id="email" class="text" type="text" name="email" value="">
                                </td>
                            </tr>
<tr><th><small><?=activate11?></small></th><td class="spacer">&nbsp;</td><td class="spacer">&nbsp;</td></tr>
                            <tr>
                            <th>
                               <?=activate6?>			</th>
                            <td class="spacer">&nbsp;</td>
                            <td class="email">
                                <input id="email" class="text" type="text" name="name" value="">
                            </td>
                                </tr>
                            <tr>
                                <th>
                                    <?=activate7?>			</th>
                                <td class="spacer">&nbsp;</td>
                                <td class="email">
                                    <input id="email" class="text" type="text" name="pw" value="">
                                    <br>
                                    <div class="error"><?php if($_GET['e']==4){
                                            echo activate8." <br/>". activate9;
                                        }?></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="submit"></th>
                                <td class="spacer">&nbsp;</td>
                                <td class="submit">
                                    <button type="submit" value="<?=activate10?>" id="button53d28ef213a1b" class="green button">
                                        <div class="button-container addHoverClick">
                                            <div class="button-background">
                                                <div class="buttonStart">
                                                    <div class="buttonEnd">
                                                        <div class="buttonMiddle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-content"><?=activate10?></div>
                                        </div>
                                    </button>

                                </td>
                            </tr>
                            </tbody></table>
                    </form>
                </div>



            </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>
        </div>





            </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>




<?php }
?>
