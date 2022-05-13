<form id="fms" action="admin.php" method="post" style="margin:0px;padding:0px">
<table style="width:100%" cellspacing="0" class="a">
<tr><td colspan="4" class="b">
<div style="float:right" class="s">
<a href="info.php?reason=link" onclick="return go('admin.php?q=rooms')" style="text-decoration:none"><?php print $lang['rooms'];?></a> <b>&middot;</b>
<a href="info.php?reason=link" onclick="return go('admin.php?q=users')" style="text-decoration:none"><?php print $lang['users'];?></a>
</div>
<div style="float:left" class="u"><?php print $lang['badwords'];?></div></td></tr>
<tr class="c"><td colspan="4">&nbsp;</td></tr>

<tr class="c"><td></td><td colspan="2" class="s">
<?php if(!is_writeable('badwords.txt')){print $lang['bwordsedit'];}?>
</td><td></td></tr>

<tr class="c"><td>&nbsp;</td><td colspan="2" class="c">
<?php $entry=file('badwords.txt');$entry=$entry[0];?>
<textarea name="badwords" cols="30" rows="8" style="width:100%;overflow:auto" <?php if(!is_writeable('badwords.txt')){print 'readonly="readonly"';}?>><?php print $entry;?></textarea>
</td><td>&nbsp;</td></tr>

<tr class="c"><td></td><td colspan="2" class="c">
<input type="submit" value="<?php print $lang['ok'];?>" />
<input type="reset" value="<?php print $lang['reset'];?>" />
</td><td></td></tr>

<tr class="c"><td colspan="4">&nbsp;</td></tr>
</table></form>