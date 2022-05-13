<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">
<table style="width:100%" cellspacing="0" class="a">
<tr><td colspan="4" class="b">
<div style="float:right" class="s">
<a href="info.php?reason=link" onclick="return go('admin.php?q=rooms')" style="text-decoration:none"><?php print $lang['rooms'];?></a> <b>&middot;</b>
<a href="info.php?reason=link" onclick="return go('admin.php?q=users')" style="text-decoration:none"><?php print $lang['users'];?></a>
</div>
<div style="float:left" class="u"><?php print $lang['mail'];?></div></td></tr>
<tr class="c"><td colspan="4">&nbsp;</td></tr>

<tr class="c"><td>&nbsp;</td><td class="s" style="text-align:right"><?php print $lang['header'];?>:</td><td class="c">
<?php $entry=output($settings['mail_header'],2);?>
<textarea name="mail_header" cols="30" rows="4" style="overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $entry;?></textarea>
</td><td>&nbsp;</td></tr>

<tr class="c"><td></td><td class="s" style="text-align:right"><?php print $lang['footer'];?>:</td><td class="c">
<?php $entry=output($settings['mail_footer'],2);?>
<textarea name="mail_footer" cols="30" rows="4" style="overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $entry;?></textarea>
</td><td></td></tr>

<tr class="c"><td colspan="4">&nbsp;</td></tr>

<tr class="c"><td></td><td class="s" style="text-align:right"><?php print $lang['activation'];?>:<br />[mail]</td><td class="c">
<?php $entry=output($settings['v_message'],2);?>
<textarea name="v_message" cols="30" rows="4" style="overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $entry;?></textarea>
</td><td></td></tr>

<tr class="c"><td></td><td class="s" style="text-align:right"><?php print $lang['activation'];?>:<br />[admin]</td><td class="c">
<?php $entry=output($settings['a_message'],2);?>
<textarea name="a_message" cols="30" rows="4" style="overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $entry;?></textarea>
</td><td></td></tr>

<tr class="c"><td></td><td class="s" style="text-align:right"><?php print $lang['password'];?>:</td><td class="c">
<?php $entry=output($settings['p_message'],2);?>
<textarea name="p_message" cols="30" rows="4" style="overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php print $entry;?></textarea>
</td><td></td></tr>

<tr class="c"><td colspan="2"></td><td class="c">
<input type="submit" value="<?php print $lang['ok'];?>" />
<input type="reset" value="<?php print $lang['reset'];?>" />
</td><td></td></tr>

<tr class="c"><td colspan="4">&nbsp;</td></tr>
</table></form>