<div id="auction">
<div class="clear"></div>
<?php
if($session->heroD['gender']==0){$gender='male';}else{$gender='female';}

$sql2 = $database->query("SELECT * FROM `heroitems` WHERE `proc` = 0 AND `num` > 0 AND uid = '".$session->uid."'");
$query2 = count($sql2);

$outputList = '';
if($query2==0){
	$outputList .= "<span class='none'>No unused items...</span>";
}
else{
	foreach($sql2 as $row){
		$id = $row["id"];$uid = $row["uid"];$btype = $row["btype"];$type = $row["type"];$num = $row["num"];$proc = $row["proc"];

		include "GameEngine/Data/alt.php";
		$outputList .= "<div class=\"\" title=\"".$name."||".$title."\" id=\"item_".$id."\">";
		$outputList .= "<div class=\"itemInInventory item ".$gender."_item_".$item." inventory\">";
		$outputList .= "<div class=\"amount\">".$num."</div>";
		$outputList .= "</div></div>";
	}
}
?>

<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">

<div class="hero_inventory">

<div id="itemsToSale">
		<?php echo $outputList; ?>			
		<div class="clear"></div>
</div>
</div>

	</div>
				</div><div class="clear"></div>
<form id="deleteForm" method="post" action="hero_auction.php?action=delete">
	<input type="hidden" name="a" value="d45">
	<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
</form>
<script type="text/javascript">
	Travian.Game.HeroAuction = new (new Class(
	{
		alreadyOpen: false,
		textSingle: '<?=HEROAC46?>',
		textMulti: '',
		initialize: function() {
			var $this = this;
<?php
$prefix = "heroitems";

$sql2 = $database->query("SELECT * FROM `heroitems` WHERE proc = 0 AND uid = '".$session->uid."'");

foreach($sql2 as $row){
$id = $row["id"];$num = $row["num"];
?>
				$('item_<?php echo $id; ?>').addEvent('click', function() { $this.deleteItem(<?php echo $id; ?>,<?php echo $num; ?>); });
<?php } ?>
						
							},
		deleteItem: function (id, amount)
        {
            var maxReached = "<?php echo $maxReached; ?>";
            if (maxReached)
            {
                return;
            }
            var html = '';
			var $this = this;
			if (this.alreadyOpen)
			{
				return;
			}
			this.alreadyOpen = true;
			$('deleteForm').id.value = id;
			//$('deleteForm').amount.value = amount;
			html = $this.textSingle;
			html.dialog(
			{
				relativeTo:			$('content'),
				buttonTextOk:		'OK',
				buttonTextCancel:	'CANCEL',
				title:				'Confirm Deletion:',
				onOpen: function(dialog, contentElement)
				{
				},
				onOkay: function(dialog, contentElement)
				{
					$('deleteForm').submit();
				},
				onClose: function(dialog, contentElement)
				{
					$this.alreadyOpen = false;
				}
			});
		}
	}));
</script>
</div>