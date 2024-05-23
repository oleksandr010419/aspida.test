
<?php
$result = $admin->search_alliance($_POST['s']);
?>
<table id="member">
  <thead>
	<tr>
		<th class="dtbl"></th><th>Found alliances (<?php echo count($result);?>)</th><th class="dtbl"></a></th>
	</tr>
  </thead>

</table>
<table id="profile">
	<tr>
		<td class="b">AID</td>
		<td class="b">Name</td>
		<td class="b">Tag</td>
		<td class="b">Founder</td>
	</tr>
<?php
if($result){
for ($i = 0; $i <= count($result)-1; $i++) {
echo '
	<tr>
		<td>'.$result[$i]["id"].'</td>
		<td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["name"].'</a></td>
		<td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["tag"].'</a></td>
		<td><a href="?p=player&uid='.$result[$i]["id"].'">'.$database->getUserField($result[$i]["leader"],'username',0).'</a></td>
	</tr>
';
}}
else{
echo '
	<tr>
		<td colspan="4">No results</td>
	</tr>
';
}
?>

</table>
