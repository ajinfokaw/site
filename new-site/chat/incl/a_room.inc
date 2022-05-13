<?php
if(isset($rid)){$rid=(int)$rid;}else{$rid=0;}

$query='SELECT * FROM '.$prefix."_rooms WHERE room_id=$rid";
$result=neutral_query($query);

if(neutral_num_rows($result)<1){redirect('admin.php?q=rooms',0,0);}

$room=neutral_fetch_array($result);

$room_id=output($room['room_id'],2);
$room_id=(int)$room_id;
$room_name=output($room['room_name'],2);
$room_desc=output($room['room_desc'],2);

?>

<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">
<table style="width:100%" cellspacing="0" class="a">
<tr><td colspan="4" class="b"><div class="u"><?php print $room_name;?></div></td></tr>
<tr class="c"><td colspan="4">&nbsp;</td></tr>

<tr class="c"><td class="c">&nbsp;</td>
<td style="text-align:right"><span class="s"><?php print $lang['name'];?>: </span></td>
<td class="c">
<input style="width:100%" type="text" maxlength="32" name="room_name" value="<?php print $room_name;?>" />
<input type="hidden" name="room_id" value="<?php print $room_id;?>" />

</td><td class="c"></td></tr>

<tr class="c"><td></td>
<td style="text-align:right"><span class="s"><?php print $lang['desc'];?>: </span></td>
<td class="c"><textarea name="room_desc" cols="20" rows="4" style="width:100%;overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $room_desc;?></textarea>
</td>
<td></td></tr>

<tr class="c"><td colspan="2"></td>
<td class="c">
<input type="submit" value="<?php print $lang['ok'];?>" />
<input type="reset" value="<?php print $lang['reset'];?>" />
</td><td></td></tr>

<tr class="c"><td colspan="4">&nbsp;</td></tr>
</table></form>