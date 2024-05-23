

<?php
$varmedal = $database->getProfileMedal($session->uid);
$userv=$database->getUser($session->uid);
if($session->sit == 0){
 ?>
<form action="spieler.php" method="POST">
    <input type="hidden" name="ft" value="p1" />
    <input type="hidden" name="uid" value="<?php echo $database->FilterIntValue($database->FilterVar($session->uid)); ?>" />
    <table cellpadding="1" cellspacing="1" id="editDetails" class="transparent">
        <tbody>
        <tr>
    <?php
    if($userv['birthday'] != 0) {
   $bday = explode("-",$userv['birthday']);
   }
   else {
   $bday = array('','','');
   }
   ?>
            <th class="birth"><?php echo OVERVIEW22; ?></th><td class="birth">
                <input tabindex="1" class="text day" type="text" name="tag" style="width:15px;" value="<?php echo $bday[2]; ?>" maxlength="2" /> <select tabindex="2" name="monat" size="" class="dropdown">

                <option value="0"></option><option value="1" <?php if($bday[1] == 1) { echo "selected"; } ?>><?php echo OVERVIEW23; ?></option><option value="2"<?php if($bday[1] == 2) { echo "selected"; } ?>><?php echo OVERVIEW24; ?></option><option value="3"<?php if($bday[1] == 3) { echo "selected"; } ?>><?php echo OVERVIEW25; ?></option><option value="4"<?php if($bday[1] == 4) { echo "selected"; } ?>><?php echo OVERVIEW26; ?></option><option value="5"<?php if($bday[1] == 5) { echo "selected"; } ?>><?php echo OVERVIEW27; ?></option><option value="6"<?php if($bday[1] == 6) { echo "selected"; } ?>><?php echo OVERVIEW28; ?></option><option value="7"<?php if($bday[1] == 7) { echo "selected"; } ?>><?php echo OVERVIEW29; ?>
                </option><option value="8"<?php if($bday[1] == 8) { echo "selected"; } ?>><?php echo OVERVIEW30; ?></option><option value="9"<?php if($bday[1] == 9) { echo "selected"; } ?>><?php echo OVERVIEW31; ?></option><option value="10"<?php if($bday[1] == 10) { echo "selected"; } ?>><?php echo OVERVIEW32; ?></option><option value="11"<?php if($bday[1] == 11) { echo "selected"; } ?>><?php echo OVERVIEW33; ?></option><option value="12"<?php if($bday[1] == 12) { echo "selected"; } ?>><?php echo OVERVIEW34; ?></option></select> <input style="width:25px;" tabindex="3" type="text" name="jahr" value="<?php echo $bday[0]; ?>" maxlength="4" class="text year"></td>

</tr>

    <tr><th><?php echo OVERVIEW12; ?></th>
    <td class="gend">
        <label><input class="radio" type="radio" name="mw" value="0" <?php if($userv['gender'] == 0) { echo "checked"; } ?> tabindex="4">-</label>
        <label><input class="radio" type="radio" name="mw" value="1" <?php if($userv['gender'] == 1) { echo "checked"; } ?> ><?=OVERVIEW39?></label>
        <label><input class="radio" type="radio" name="mw" value="2" <?php if($userv['gender'] == 2) { echo "checked"; } ?> ><?=OVERVIEW40?></label>
    </td></tr>

    <tr><th><?php echo OVERVIEW13; ?></th><td>
		<?php
		/*<input tabindex="5" type="text" name="ort" value="<?php echo $userv['location']; ?>" maxlength="30" class="text">*/
			echo FIRST_DESC_COUNTRY_SELECT . ': <select name="country" id="countrySelect">';
			$countries = $database->query('SELECT IsoCountryCode, Country FROM CountryTbl ORDER BY Country ASC');
			echo '<option value="-1">- Select Country -</option>';
			foreach ($countries as $thisCountry) {
				echo '<option value="' . $thisCountry['IsoCountryCode'] . '" '.($userv['IsoCountryCode']==$thisCountry['IsoCountryCode']?'selected="selected"':"").'>' . $thisCountry['Country'] . '</option>';
			}
			echo '</select>';
			if($form->getError("country") != "") {
				echo "<span class=\"error\">".$form->getError('country')."</span>";
			}
		?>
		<script>
		function bindCountryChange(){
			j$('#countrySelect').unbind('change').bind('change', function(){
				setFlag();
			});
		}
		function setFlag(){
			var countryCode = j$('select[name=country]').val();
			var countryImg = '<img src="img/flags-iso/shiny/64/' + countryCode + '.png">';
			j$('#countryflag').html(countryImg);
		}
		window.addEvent('domready', function()
        {
			bindCountryChange();
			setFlag();
		});
		</script>
	<div id="countryflag"></div>
	
	</td></tr>


    <tr><td colspan="2" class="empty"></td></tr>
    <?php
      $nazvanie= OVERVIEW17;
    echo "<tr><th>".$nazvanie."</th><td><input tabindex=\"6\" type=\"text\" name=\"dname\" value=\"".$database->RemoveXSS($village->vname)."\" maxlength=\"16\" class=\"text\"></td></tr>";

    ?>

    </table>

    <h4 class="round spacer"><?=OVERVIEW3?></h4>
    <textarea tabindex="7" style="text-align:center;" class="editDescription editDescription1" name="be2"><?php echo $userv['desc2']; ?></textarea>
    <textarea tabindex="6" style="text-align:center;" class="editDescription editDescription2" name="be1"><?php echo $userv['desc1']; ?></textarea>
    <div class="clear"></div>

    <div class="switchWrap">
        <div class="openedClosedSwitch switchClosed" id="switchMedals"><?=OVERVIEW35?></div>
        <div class="clear"></div>
    </div>
	<p>

    <div id="medals" class="hide">
    <table cellpadding="1" cellspacing="1">
        <thead>
		<tr>
			<td><?php echo OVERVIEW36; ?></td>
			<td><?php echo OVERVIEW4; ?></td>
			<td><?php echo OVERVIEW37; ?></td>
			<td>BB-<?php echo OVERVIEW38; ?></td>
        </tr>
        </thead>
        <tbody>
				<?php
					$podryad=MEDAL19;
	$times=TIMES;
	$podryad=$times." ".$podryad;
	$titel=BONUS;
	$days=DNYA;
	foreach($varmedal as $medal) {

	switch ($medal['categorie']) {
    case "1":
        $titel=MEDAL1;
        $titel=$titel." ".$days;
        break;
    case "2":
       $titel=MEDAL2;
        $titel=$titel." ".$days;
        break;
    case "3":
        $titel=MEDAL3;
         $titel=$titel." ".$days;
        break;
    case "4":
        $titel=MEDAL4;
        $titel=$titel." ".$days;
        break;
    case "5":
        $titel=MEDAL5;
        $titel=$titel." ".$days;
        break;
    case "6":
     $titel0=MEDAL6;

          $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "7":
            $titel0=MEDAL7;

        $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "8":
                   $titel0=MEDAL8;

         $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "9":
                    $titel0=MEDAL9;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "10":
                $titel=MEDAL10;
        $titel=$titel." ".$days;
        break;
    case "11":
                            $titel0=MEDAL11;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "12":
                            $titel0=MEDAL12;
      $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
            case "17":
                $titel=MEDAL17;
        $titel=$titel." ".$days;
        break;
                    case "18":
                $titel=MEDAL18;
        $titel=$titel." ".$days;
        break;

	}
				 echo"<tr>
				   <td> ".$titel."</td>
				   <td>".$medal['plaats']."</td>
				   <td>".$medal['week']."</td>
				   <td>[#".$medal['id']."]</td>
			 	 </tr>";
				 } 

                 ?>
				 <tr>
				   <td><?=INS31?></td>
				   <td></td>
				   <td></td>
				   <td>[#0]</td>
			 	 </tr>
                </tbody>
				 </table>

<table cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <td><?php echo OVERVIEW36; ?></td>
            <td><?php echo OVERVIEW42; ?></td>
            <td><?php echo OVERVIEW41; ?></td>
            <td>BB-<?php echo OVERVIEW38; ?></td>
        </tr>
    </thead>
    <tbody>
    <?php   
	$main_id = $session->main_id;
	if($main_id == null){	
		$main_id_data = json_decode(file_get_contents("https://aspidanetwork.com/api.php?email=".$session->email));
		$main_id = $main_id_data->uid;
	}
	
    if($main_id != null){
         $main_medals_data = json_decode(file_get_contents("https://aspidanetwork.com/api.php?id=".$main_id));
         foreach($main_medals_data->medals as $medal) {
                echo"<tr>
               <td> " .constant('MEDAL_'.$medal->category)."</td>
               <td>".$medal->server."</td>
               <td>".$medal->round."</td>
               <td>[#m".$medal->category."]</td>
             </tr>";
         }

    }?>
    </tbody>
</table>
</div>


    <div class="submitButtonContainer">
<script type="text/javascript">
        window.addEvent('domready', function()
        {
            if ($('switchMedals'))
            {
                $('switchMedals').addEvent('click', function(e)
                {
                    Travian.toggleSwitch($('medals'), $('switchMedals'));
                });
            }
        });


    </script><?php
               }
?>
<h4 class="round"><?php echo OVERVIEW7; ?></h4>
<table cellpadding="1" cellspacing="1" id="villages">
    <thead>
    <tr>
        <th class="name"><?php echo OVERVIEW17; ?></th>
        <th><?=FINDER12?></th>
        <th><?php echo OVERVIEW18; ?></th>
        <th><?php echo OVERVIEW19; ?></th>
    </tr>
    </thead><tbody>
    <?php
    $name = 0;
    $varray = $database->getProfileVillages($session->uid);
    foreach($varray as $vil) {

        $capital= OVERVIEW20;
        echo "<tr><td class=\"name\"><input tabindex=\"6\" type=\"text\" name=\"dname".$vil['wref']."\" value=\"".$vil['name']."\" maxlength=\"20\" class=\"text\">";

        if($vil['capital'] == 1) {
            echo "<span class=\"mainVillage\"> (".$capital.")</span>";
        }
        echo "</td><td class=\"oases\">";
        echo "</td>";
        echo "<td class=\"inhabitants\">".$vil['pop']."</td><td class=\"coords\"><a href=\"karte.php?x=".$vil['vx']."&y=".$vil['vy']."\"><span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">";
        echo "<span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">
        <span class=\"coordinateX\">(".$vil['vx']."</span>
        <span class=\"coordinatePipe\">|</span>
        <span class=\"coordinateY\">".$vil['vy'].")</span>
        </span><span class=\"clear\">‎</span>
        </td></tr>";
        $name++;
    }
    ?>
    </tbody></table>
        <br />
        <button type="submit"   class="green">
            <div class="button-container addHoverClick"> <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content"><?=SAVE?></div>
            </div>
        </button>
    </div>
</form>