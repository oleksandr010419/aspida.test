<div id="raidListCreate">
	<h4><?=farmlist9?></h4>
	<?php if(isset($_GET['error']) && $_GET['error'] == "nolist"){?>
	<font color="#FF0000"><b>   
		You need to create a raid list before adding farms
    </b></font>
	<?php } ?>
	<form action="build.php?gid=16&t=99" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addList">
			<table cellpadding="1" cellspacing="1" class="transparent">
				<tbody><tr>
					<th>
						<?=farmlist11?>:					</th>
					<td>
						<input class="text" id="name" name="name" type="text">
					</td>
				</tr>
				<tr>
					<th>
						<?=farmlist0?>					</th>
					<td>
                    
						<select id="did" name="did">
<?php
foreach($session->vvillages as $vil) {
    if($vil['wref'] == $village->wid){
    	$select = 'selected="selected"';
    }else{
        $select = '';
    }
    
		echo "<option value=\"".$vil['wref']."\" ".$select.">".$vil['name']."</option>";
    }
?>						</select>
					</td>
				</tr>
			</tbody></table>

			</div>
				</div>

        <button type="submit" value="create" class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= farmlist12 ?></div>
            </div>
        </button>
    </form>
</div>
