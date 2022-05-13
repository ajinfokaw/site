<?php
$query='SELECT * FROM '.$prefix.'_rooms';
$result=neutral_query($query);

?>
<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">
<table style="width:100%" cellspacing="1" class="d">
<tr><td colspan="2" class="b">
<div style="float:right" class="s">
<a href="info.php?reason=link" onclick="return go('admin.php?q=main')" style="text-decoration:none"><?php print $lang['settings'];?></a> <b>&middot;</b>
<a href="info.php?reason=link" onclick="return go('admin.php?q=users')" style="text-decoration:none"><?php print $lang['users'];?></a>
</div>
<div style="float:left" class="u"><?php print $lang['rooms'];?></div></td></tr>

<?php
while($room=neutral_fetch_array($result)){
$room_id=output($room['room_id'],2);
$room_id=(int)$room_id;
$room_name=output($room['room_name'],2);
$room_desc=output($room['room_desc'],2);
print '<tr class="c"><td class="c" style="padding:15px"><b>'.$room_name.'</b><div class="s">'.$room_desc.'</div></td><td class="s" style="padding:5px;white-space:nowrap;text-align:center">';
print '<a href="info.php?reason=link" onclick="return go(\'admin.php?empty='.$room_id.'\')">'.$lang['empty'].'</a> <b>&middot;</b> ';
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?q=room\'+amp+\'rid='.$room_id.'\';go(lnk);return false">'.$lang['edit'].'</a> <b>&middot;</b> ';
if($room_id>1){print '<a href="info.php?reason=link" onclick="lnk=\'admin.php?del_room='.$room_id.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['delete'].'</a>';}
else{print $lang['delete'];}
print '</td></tr>';
$new_id=$room_id+1;
}
?>
<tr class="c"><td colspan="2" style="padding:10px;text-align:center"><a class="s" href="info.php?reason=link" onclick="return go('admin.php?empty=0')"><?php print $lang['empty_all'];?></a></td></tr>
<tr class="c"><td colspan="2" style="padding:15px;text-align:center;white-space:nowrap">
<input type="text" style="width:70%" maxlength="32" name="new_room" value="<?php print $lang['room'].' #'.$new_id;?>" />
<input type="submit" value="<?php print $lang['ok'];?>" />
</td></tr>
</table></form>