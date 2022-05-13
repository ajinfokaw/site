<?php
if(isset($uid)){$uid=(int)$uid;}else{$uid=0;}

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$uid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$user_details=neutral_fetch_array($result);}
else{die('</div></div><div class="z"></div></body></html>');}
?>
<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">

<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4"><span class="u"><?php output($user_details['usr_name'],1);?></span></td></tr>

<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>

<tr class="c"><td class="c">&nbsp;<input type="hidden" name="uid" value="<?php print $uid;?>" /></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['name'];?>:</span></td>
<td class="c"><input size="32" type="text" maxlength="32" name="name" value="<?php output($user_details['usr_name'],1);?>" /></td>
<td class="c">&nbsp;</td></tr>

<tr class="c"><td class="c">&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['mail'];?>:</span></td>
<td class="c"><input size="32" type="text" maxlength="32" name="mail" value="<?php output($user_details['usr_mail'],1);?>" /></td>
<td class="c">&nbsp;</td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['timezone'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="offset">
<?php 

switch($user_details['usr_format']){
case '1':$format='h:i:s A';break;
case '2':$format='Y-m-d H:i:s';break;
case '3':$format='d.m.Y H:i:s';break;
case '4':$format='m/d/Y h:i:s A';break;
default:$format='H:i:s';break;}

for($i=-12;$i<=13;$i++){
if($i!=0){$gmt='';}else{$gmt=' GMT';}
if($i==$user_details['usr_offset']){$sel=' selected="selected"';}else{$sel='';}
$show_time=gmdate($format,time()+$i*3600);

print '<option value="'.$i.'"'.$sel.'>'.$show_time.$gmt.'</option>';}?></select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['time_format'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="format">
<?php
$show_time=gmdate('H:i:s',time()+$user_details['usr_offset']*3600);
if($user_details['usr_format']==0){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('Y-m-d H:i:s',time()+$user_details['usr_offset']*3600);
if($user_details['usr_format']=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('d.m.Y H:i:s',time()+$user_details['usr_offset']*3600);
if($user_details['usr_format']=='3'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="3"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('m/d/Y h:i:s A',time()+$user_details['usr_offset']*3600);
if($user_details['usr_format']=='4'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="4"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('h:i:s A',time()+$user_details['usr_offset']*3600);
if($user_details['usr_format']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$show_time.'</option>';
?>
</select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['sex'].'/'.$lang['age'];?>:</span></td><td class="c">
<div style="float:left">
<select style="width:90px;font-size:10px" name="sex">
<?php
if($user_details['usr_sex']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>&nbsp;</option>';
if($user_details['usr_sex']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['male'].'</option>';
if($user_details['usr_sex']=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$lang['female'].'</option>';
?>
</select></div>
<div style="float:right">
<select style="width:90px;font-size:10px" name="age">
<option value="0">&nbsp;</option>
<?php

$current=gmdate('Y',time());
$start_i=$current-80;
$end_i=$current-10;

for($i=$start_i;$i<$end_i;$i++){
if($user_details['usr_age']==$i){$sel=' selected="selected"';}else{$sel='';}
print '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
?>
</select></div>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['sound'].'/'.$lang['fun'];;?>:</span></td>
<td class="c">
<div style="float:left">
<select style="width:90px;font-size:10px" name="snd">
<?php
if($user_details['usr_snd']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($user_details['usr_snd']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
?>
</select></div>
<div style="float:right">
<select style="width:90px;font-size:10px" name="fun">
<?php
if($user_details['usr_fun']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($user_details['usr_fun']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
?>
</select></div>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['location'];?>:</span></td>
<td class="c"><input size="32" type="text" name="location" maxlength="32" value="<?php output($user_details['usr_location'],1);?>" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['website'];?>:</span></td>
<td class="c"><input size="32" type="text" name="website" maxlength="50" value="<?php output($user_details['usr_website'],1);?>" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['info'];?>:</span></td>
<td class="c"><textarea name="info" cols="20" rows="5" style="width:100%;overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php output($user_details['usr_info'],1);?></textarea></td>
<td class="c"></td></tr>

<tr class="c"><td></td><td valign="top" rowspan="3">
<?php
$path='';$pic='incl/no_pic.png';
if(strlen($user_details['usr_avatar'])>10){
$pic=output($user_details['usr_avatar'],2);
$path=escape($pic);}$current=escape($pic);
print '<script type="text/javascript">current_path=\''.$current.'\';</script>';

?>
<img id="avtr" src="<?php print $pic;?>" class="i" style="float:right;width:60px;height:60px;padding:1px;border:1px solid" alt="" />
</td><td class="c">&nbsp;</td><td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c"><input size="32" type="text" name="avatar" maxlength="255" value="<?php print $path;?>" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<input type="reset" onclick="document.getElementById('avtr').src=current_path;document.getElementById('infm').style.display='none'" value="<?php print $lang['reset'];?>" />
<input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>

</form>