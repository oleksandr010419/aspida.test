<?php

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\"><?=INS10?></span></div><br>";
}


?><!--Timestamp-->
<div class="b-articlesmall">
    <form name="hf" onsubmit="return false;">
        <table>
           <tr><td><?=INS11?></td><td><?=INS12?></td><td><?=INS13?></td><td> </td><td><?=INS14?></td><td><?=INS15?></td><td><?=INS16?></td><td></td></tr>
            <tr><td><input type="text" size="1" maxlength=2 value="1" name="mm">  </td>
                <td><input type="text" size=1 maxlength=2 value="1" name="dd"></td>
                <td><input type="text" size=3 maxlength=4 value="1970" name="yyyy"></td>
<td></td>
                <td><input type="text" size=3 maxlength=2 value="0" name="hh"> </td>
                <td><input type="text" size=3 maxlength=2 value="0" name="mn"></td>
                <td><input type="text" size=3 maxlength=2 value="0" name="ss"></td>
                <td> <input type="button" title="date in Timestamp" value="date in Timestamp" onClick="HumanToEpoch();"></td>
            </tr></table>
        <div id="result2"> </div>
    </form>
    <br /></div>
<form action="process.php" method="post" id="dataform">

    <!--General Settings
		(server name/server speed/troop speed/Marketplace capacity/Cranny/Map capacity/Homepage URL/New player protection/Warehouse capacity/Arena action (after x squares)/How meny adventures gives per day)-->
	<p>
    <table><tr>
            <td><span class="f9 c6"><?=INS17?></span></td><td width="140"><input type="text" name="servername" id="servername" value="Aspida x1.000"></td></tr><tr>

            <td><span class="f9 c6"><?=INS18?></span></td><td><input name="speed" type="text" id="speed" value="1000" size="2"></td></tr><tr>
            <td><span class="f9 c6"><?=INS19?></span></td><td width="140"><input type="text" name="incspeed" id="incspeed" value="50" size="2"></td></tr><tr>

            <td><span class="f9 c6"><?=INS20?></span></td><td width="140"><input type="text" name="tradercap" id="tradercap" value="1000" size="2"></td></tr>
        <td><span class="f9 c6"><?=TA2?></span></td><td width="140"><input type="text" name="cranny" id="tradercap" value="1000" size="2"></td></tr>
            <td><span class="f9 c6"><?=INS21?></span></td><td>
                <select name="wmax">
                    <option value="100"><?=INS23?></option>
                    <option value="200" selected="selected"><?=INS25?></option>
                    <option value="300"><?=INS27?></option>
                    <option value="400"><?=INS29?></option>
                </select>
            </td></tr>

        <td><span class="f9 c6"><?=INS30?></span></td><td><input name="homepage" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td></tr>

        <td><span class="f9 c6"><?=INS31?></span></td><td>
            <select name="beginner">
                <option value="7200"><?=INS31M?></option>
                <option value="10800"><?=INS32?></option>
                <option value="18000" selected="selected"><?=INS33?></option>
                <option value="28800"><?=INS34?></option>
                <option value="36000"><?=INS35?></option>
                <option value="43200"><?=INS36?></option>
                <option value="86400"><?=INS37?></option>
                <option value="172800"><?=INS38?></option>
                <option value="259200"><?=INS39?></option>
                <option value="432000"><?=INS40?></option>
            </select>
        </td></tr>


        <td><span class="f9 c6"><?=INS41?></span></td><td width="140"><input type="text" name="storage_multiplier" id="storage_multiplier" value="1000"></td></tr><tr>
            <td><span class="f9 c6"><?=INS42?></span></td><td width="140"><input type="text" name="ts_threshold" id="ts_threshold" value="20"></td></tr><tr>
            <td><span class="f9 c6"><?=INS129?></span></td><td width="140"><input type="text" name="adv" id="advent" value="20"></td>



    </table>
    </p>

    <p>
        <span class="f10 c"><?=INS43?></span>
    <table>

        <td><span class="f9 c6"><?=INS44?></span></td><td>
            <select name="admin_rank">
                <option value="True" selected="selected"><?=INS45?></option>
                <option value="False"><?=INS46?></option>
            </select>
        </td>
    </table>
    </p>

    <p>
        <span class="f10 c"><?=INS47?></span><!--Admin-->
    <table><tr>
            <td><span class="f9 c6"><?=INS48?></span></td><td><input name="sserver" type="text" id="sserver" value="localhost"></td></tr><tr>
            <td><span class="f9 c6"><?=INS49?></span></td><td><input name="suser" type="text" id="suser" value="aspidane_strat1"></td></tr><tr>
            <td><span class="f9 c6"><?=INS50?></span></td><td><input type="password" name="spass" id="spass" value="rockdaleplaza1"></td></tr><tr>
            <td><span class="f9 c6"><?=INS51?></span></td><td><input type="text" name="sdb" id="sdb" value="aspidane_x1000"></td></tr><tr>

    </table>
    </p>
<br />
    <span class="f10 c"><?=INS52?></span><!--Travian plus options-->
    <table>
        <td><span class="f9 c6"><?=INS53?></span></td><td>
            <select name="plus_time">
                <option value="(3600*4)"><?=INS54A?></option>
                <option value="(3600*12)" selected="selected"><?=INS54?></option>
                <option value="(3600*24)"><?=INS55?></option>
                <option value="(3600*24*2)"><?=INS56?></option>
                <option value="(3600*24*3)"><?=INS57?></option>
                <option value="(3600*24*4)"><?=INS58?></option>
                <option value="(3600*24*5)"><?=INS59?></option>
                <option value="(3600*24*6)"><?=INS60?></option>
                <option value="(3600*24*7)"><?=INS61?></option>
            </select>
        </td></tr>
        <td><span class="f9 c6"><?=INS62?></span></td><td>
            <select name="plus_production">
                <option value="(3600*4)"><?=INS54A?></option>
                <option value="(3600*12)" selected="selected"><?=INS63?></option>
                <option value="(3600*24)"><?=INS64?></option>
                <option value="(3600*24*2)"><?=INS65?></option>
                <option value="(3600*24*3)"><?=INS66?></option>
                <option value="(3600*24*4)"><?=INS67?></option>
                <option value="(3600*24*5)"><?=INS68?></option>
                <option value="(3600*24*6)"><?=INS69?></option>
                <option value="(3600*24*7)"><?=INS70?></option>
            </select>
			
        </td></tr>
		<td><span class="f9 c6"><?=ATTACK1?></span></td><td>
            <select name="offense1_bonus">
                <option value="5"><?=ATTACK1_5?></option>
                <option value="10"><?=ATTACK1_10?></option>
                <option value="15"><?=ATTACK1_15?></option>
                <option value="20"><?=ATTACK1_20?></option>
                <option value="25" selected="selected"><?=ATTACK1_25?></option>
                <option value="30"><?=ATTACK1_30?></option>
                <option value="40"><?=ATTACK1_40?></option>
                <option value="50"><?=ATTACK1_50?></option>
				<option value="100"><?=ATTACK1_100?></option>
            </select>
		<tr><td><span class="f9 c6"><?=ATTACK2?></span></td><td width="140"><input type="text" name="offense1_cost" id="offense1_cost" value="50" size="2"></td></tr>
        </td></tr>
		<td><span class="f9 c6"><?=DEF1?></span></td><td>
            <select name="defence1_bonus">
                <option value="5"><?=DEF1_5?></option>
                <option value="10"><?=DEF1_10?></option>
                <option value="15"><?=DEF1_15?></option>
                <option value="20"><?=DEF1_20?></option>
                <option value="25" selected="selected"><?=DEF1_25?></option>
                <option value="30"><?=DEF1_30?></option>
                <option value="40"><?=DEF1_40?></option>
                <option value="50"><?=DEF1_50?></option>
				<option value="100"><?=DEF1_100?></option>
            </select>
		<tr><td><span class="f9 c6"><?=DEF2?></span></td><td width="140"><input type="text" name="defence1_cost" id="defence1_cost" value="50" size="2"></td></tr>	
		
		<td><span class="f9 c6"><?=OFF_DEF_TIME1?></span></td><td>
            <select name="off_def_time">
				<option value="3600"><?=OFF_DEF_TIME_1?></option>
                <option value="7200"><?=OFF_DEF_TIME_2?></option>
                <option value="10800"><?=OFF_DEF_TIME_3?></option>
                <option value="21600"><?=OFF_DEF_TIME_6?></option>
                <option value="43200" selected="selected"><?=OFF_DEF_TIME_12?></option>
                <option value="86400"><?=OFF_DEF_TIME_24?></option>
                
            </select>
        </td></tr>
       </td></tr>
        <tr><td><span class="f9 c6"><?=INS71?></span></td><td width="140"> <select name="SELL_RES">
                    <option value="True"><?=INS72?></option>
                    <option value="False" selected="selected"><?=INS73?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS74?></span></td><td width="140"><select name="SELL_CP">
                    <option value="True" selected="selected"><?=INS75?></option>
                    <option value="False"><?=INS76?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS77?></span></td><td width="140"><input type="text" name="howres" id="start_time" value="0"></td></tr>
        <tr><td><span class="f9 c6"><?=INS78?></span></td><td width="140"><input type="text" name="costres" id="start_time" value="0"></td></tr>
        <tr><td><span class="f9 c6"><?=INS79?></span></td><td width="140"><input type="text" name="costcp" id="start_time" value="20"></td></tr>

        <tr><td><span class="f9 c6"><?=INS80?></span></td><td width="140"><input type="text" name="howcp" id="start_time" value="1000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS81?></span></td><td width="140"><input type="text" name="defgold" id="start_time" value="300"></td></tr>
		<tr><td><span class="f9 c6"><?=POP_TO_GET_GOLD1?></span></td><td width="140"><input type="text" name="pop_to_get_gold" id="pop_to_get_gold" value="1000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS82?></span></td><td width="140"><input type="text" name="refpop" id="start_time" value="500"></td></tr>
        <tr><td><span class="f9 c6"><?=INS83?></span></td><td width="140"><input type="text" name="refgold" id="start_time" value="50"></td></tr>
    </table>



   
	<br/><br/>
	Include special features ? <select name="extra_menu"><option value="TRUE">Yes</option><option value="FALSE">No</option></select><br/>
	Can complete training instantly ? <select name="instant_train"><option value="TRUE">Yes</option><option value="FALSE">No</option></select><br/>
	Instant training gold modifier <input name="instant_train_mod" value="61.3">
	
	<br/>
    <br />
    <span class="f10 c"><?=INS84?></span>
    <table>
        <tr><td><span class="f9 c6"><?=INS85?><small><?=INS86?> </small></span></td><td width="140"><input type="text" name="opening" id="start_time" value="<?php echo time(); ?>"></td></tr>
        <!--<tr><td><span class="f9 c6"><?=INS87?><small><?=INS88?> </small></span></td><td width="140"><input type="text" name="ARTEFACTS" id="start_time" value="<?php echo time()+3600*24*3; ?>"></td></tr>
        <tr><td><span class="f9 c6"><?=INS89?><small><?=INS90?></small></span></td><td width="140"><input type="text" name="WW_TIME" id="start_time" value="<?php echo time()+3600*24*6; ?>"></td></tr>
        <tr><td><span class="f9 c6"><?=INS91?><small><?=INS92?></small></span></td><td width="140"><input type="text" name="WW_PLAN" id="start_time" value="<?php echo time()+3600*24*6; ?>"></td></tr>-->
		<tr><td><span class="f9 c6"><?=ROUND_LENGTH1?><small><?=ROUND_LENGTH2?></small></span></td><td width="140"><input type="text" name="round_length" id="round_length" value="3"></td></tr>

        <tr>        <td><span class="f9 c6"><?=INS92M?></span></td><td><select name="village_expand">
                    <option value="1" selected="selected"><?=INS93?></option>
                    <option value="0"><?=INS94?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS95?></span></td><td width="140"><select name="QUEST">
                    <option value="True" selected="selected"><?=INS96?></option>
                    <option value="False"><?=INS97?></option>
                </select></td></tr>
        <tr><td><span class="f9 c6"><?=INS98?><br/><small><?=INS107?><br /><?=INS110?></small></span></td><td width="140"><input type="text" name="MAX_FILES" id="start_time" value="1000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS99?><br/><small><br /><?=INS108?></small></span></td><td width="140"><input type="text" name="MAX_FILESH" id="start_time" value="3000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS100?><br/><small><?=INS109?><br /><?=INS111?></span></td><td width="140"><input type="text" name="IMGQUALITY" id="start_time" value="50"></td></tr>
        <tr><td><span class="f9 c6"><?=INS101?></span></td><td width="140"><select name="MOMENT_TRAIN">
                    <option value="True"><?=INS102?></option>
                    <option value="False" selected="selected"><?=INS103?></option>
                </select></td></tr>


        <tr><td><span class="f9 c6"><?=INS104?></span></td><td width="140"><input type="text" name="auctime" id="start_time" value="7200"></td></tr>


        <tr><td><span class="f9 c6"><?=INS105?></span></td><td width="140"><input type="text" name="oasisx" id="start_time" value="1000"></td></tr>
        <tr><td><span class="f9 c6"><?=INS106?></span></td><td width="140"><input type="text" name="phour" id="start_time" value="3600"></td></tr>
    </table>


    <center>
        <input type="submit" name="Submit" id="Submit" value="Submit">
        <input type="hidden" name="subconst" value="1"></center>
</form>

