<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">
<table style="width:100%" cellspacing="0" class="a">
<tr><td colspan="4" class="b">
<div style="float:right" class="s">
<a href="info.php?reason=link" onclick="return go('admin.php?q=rooms')" style="text-decoration:none"><?php print $lang['rooms'];?></a> <b>&middot;</b>
<a href="info.php?reason=link" onclick="return go('admin.php?q=users')" style="text-decoration:none"><?php print $lang['users'];?></a>
</div>
<div style="float:left" class="u"><?php print $lang['settings'];?></div></td></tr>
<tr class="c"><td colspan="4">&nbsp;</td></tr>

<tr class="c"><td>&nbsp;</td><td></td><td class="c"><span class="s"><?php include $php;?></span></td><td>&nbsp;</td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right">URL:</td>
<td class="c">
<?php $entry=output($settings['url'],2);?>
<input style="width:95%" type="text" name="url" maxlength="50" value="<?php print $entry;?>" />
</td><td></td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right"><?php print $lang['mail'];?>:</td>
<td class="c">
<?php $entry=output($settings['default_mail'],2);?>
<input style="width:95%" type="text" name="mail" maxlength="50" value="<?php print $entry;?>" />
</td><td></td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right"><?php print $lang['title'];?>:</td>
<td class="c">
<?php $entry=output($settings['title'],2);?>
<input style="width:95%" type="text" name="title" maxlength="127" value="<?php print $entry;?>" />
</td><td></td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right"><?php if($settings['extension']>0){print $lang['suffix'].':';}?></td>
<td class="c">
<?php 
if($settings['extension']>0){
$entry=output($settings['suffix'],2);
print '<input style="width:95%" type="text" name="suffix" maxlength="3" value="'.$entry.'" />';}?>

</td><td></td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right"><?php print $lang['guest'].'&nbsp;[N]';?>:</td>
<td class="c">
<?php $entry=output($settings['guest_name'],2);$entry=trim($entry);?>

<input class="s" style="width:95%" type="text" name="guest_name" maxlength="32" value="<?php print $entry;?>" />
</td><td></td></tr>

<tr class="c">
<td></td><td class="s" style="text-align:right"><?php print $lang['guest'].'&nbsp;[P]';?>:</td>
<td class="c">
<?php $entry=output($settings['guest_pass'],2);$entry=trim($entry);?>

<input class="s" style="width:95%" type="text" name="guest_pass" maxlength="32" value="<?php print $entry;?>" />
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="reg_on">
<?php
if($settings['reg_on']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
if($settings['reg_on']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print '[register.php] &amp; [password.php]';?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="guest_help">
<?php
if($settings['guest_help']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
if($settings['guest_help']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
?></select>
</td><td class="c"><span class="s">
<?php print $lang['sett1'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="activation">
<?php
if($settings['activation']=='mail'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="mail"'.$sel.'>'.$lang['on'].'</option>';
if($settings['activation']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($settings['activation']=='admin'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="admin"'.$sel.'>[A]</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print $lang['sett2'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="compression">
<?php
if($settings['gzip']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
if($settings['gzip']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($settings['gzip']=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>[A]</option>';
?></select>
</td><td class="c"><span class="s">
<?php print $lang['sett3'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="max_users">
<?php
if($settings['max_users']=='5'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="5"'.$sel.'>5</option>';
if($settings['max_users']=='10'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="10"'.$sel.'>10</option>';
if($settings['max_users']=='20'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="20"'.$sel.'>20</option>';
if($settings['max_users']=='50'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="50"'.$sel.'>50</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print $lang['sett4'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="max_upload">
<?php
if($settings['max_upload']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($settings['max_upload']=='20'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="20"'.$sel.'>20</option>';
if($settings['max_upload']=='50'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="50"'.$sel.'>50</option>';
if($settings['max_upload']=='100'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="100"'.$sel.'>100</option>';
if($settings['max_upload']=='200'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="200"'.$sel.'>200</option>';
if($settings['max_upload']=='500'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="500"'.$sel.'>500</option>';
if($settings['max_upload']=='750'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="750"'.$sel.'>750</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print $lang['sett5'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="turing_number">
<?php
if($settings['turing_number']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
if($settings['turing_number']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print $lang['sett6'];?>
</span></td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<select class="s" style="width:50px" name="turing_live">
<?php
if($settings['turing_live']=='15'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="15"'.$sel.'>15</option>';
if($settings['turing_live']=='30'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="30"'.$sel.'>30</option>';
if($settings['turing_live']=='60'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="60"'.$sel.'>60</option>';
if($settings['turing_live']=='120'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="120"'.$sel.'>120</option>';
?>
</select>
</td><td class="c"><span class="s">
<?php print $lang['sett7'];?>
</span></td><td></td></tr>

<tr class="c"><td>&nbsp;</td><td>&nbsp;</td>
<td class="c"><ul style="padding:2px">
<li class="s"><b><a style="text-decoration:none" href="info.php?reason=link" onclick="go('admin.php?q=mail');return false"><?php print $lang['mail_tmpl'];?></a></b></li>
<li class="s"><b><a style="text-decoration:none" href="info.php?reason=link" onclick="go('admin.php?q=word');return false"><?php print $lang['badwords'];?></a></b></li>
<li class="s"><b><a style="text-decoration:none" href="info.php?reason=link" onclick="go('backup.php');return false"><?php print $lang['backup'];?></a></b></li>
</ul></td><td></td></tr>

<tr class="c"><td colspan="2"></td>
<td class="c">
<input type="submit" value="<?php print $lang['ok'];?>" />
<input type="reset" value="<?php print $lang['reset'];?>" />
</td><td></td></tr>
<tr class="c"><td colspan="4">&nbsp;</td></tr>

</table></form>