<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editVillage.tpl                                             ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

$id = $_GET['did'];
$village = $database->getVillage($id);
$user = $database->getUserArray($village['owner'],1);
$coor = $database->getCoor($village['wref']);
$varray = $database->getProfileVillages($village['owner']);
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
if(isset($id))
{
	include("search2.tpl"); ?>
	<form action="../GameEngine/Admin/Mods/editBuildings.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="id" value="<?php echo $_GET['did']; ?>" />
		<br />



		<br />

		<table id="member" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="4">Modify Buildings</th>
				</tr>
				<tr>
					<td class="on">ID</td>
					<td class="on">GID</td>
					<td class="hab">Name</td>
					<td class="on">Level</td>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($i = 1; $i <= 41; $i++)
				{       if($i==41){ $i=99;}
					if($fdata['f'.$i.'t'] == 0)
					{
						$bu = "-";
					}
					else
					{
						$bu = $funct->procResType($fdata['f'.$i.'t']);
					}
					echo '
						<tr>
							<td class="on">'.$i.'</td>
							<td class="on"><input class="fm" name="id'.$i.'gid" value="'.$fdata['f'.$i.'t'].'"></td>
							<td class="hab">'.$bu.'</td>
							<td class="on"><input class="fm" name="id'.$i.'level" value="'.$fdata['f'.$i].'"></td>
						</tr>';
						if($i==99){ break;}
				}
				?>
                <tr>
                    <td class="on">-</td>
                    <td class="on">WW name</td>
                    <td class="hab"><input class="fm" name="wwname" value="<?=$fdata['wwname']?>"></td>
                    <td class="on">-</td>
                </tr>
			</tbody>
		</table>

		<br /><br />
		<center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center>

		<br />
		
	</form>
<a href="#" onclick="showStuff('instructions'); return false;">Show Instructions</a>
<span id="instructions" style="display: none;">
			<h4>Building ID's (Position)</h4>
			<div  class="village1" >
                <div id="village_map" class="f<?php echo $database->getVillageType($village['wref']); ?>" >
                    <?php
						for($f = 1; $f <19; $f++)
						{
							##$gid = $fdata['f'.($f).'t'];
							##$level = $fdata['f'.($f)];
							echo "<img src=\"../img/x.gif\" class=\"reslevel rf".$f." level".$f."\">";
                    }
                    ?>
                </div>
            </div>

		

    <table id="member">
        <thead>
        <tr>
            <th colspan="2">Buildings</th>
        </tr>
        <tr>
            <td>GID</td>
            <td>Name</td>
        </tr>
        </thead>
        <tbody>
		
        <?php
						for($i =1; $i<=45; $i++)
						{
							$bu = $funct->procResType($i);
        echo '
        <tr>
            <td class="on">'.$i.'.</td>
            <td class="on">'.$bu.'</td>
        </tr>';
        }
        ?>

        </tbody>
    </table>
			<a href="#" onclick="hideStuff('instructions'); return false;">Hide Instructions</a>
		</span>


<?php
}
else
{
include("404.tpl");
}
?>