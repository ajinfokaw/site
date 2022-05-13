<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';
include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<form action="index.php" method="post" id="fms" style="padding:0px;margin:0px">
<div style="width:290px;margin:auto">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4">
<?php print $lang['settings'];?></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['lang'];?>:</span></td>
<td class="c" style="width:65%">
<select style="width:100%;font-size:10px" name="language">
<?php

require_once 'lang/languages.inc';
for($i=0;$i<count($lang_files);$i++){
if(isset($blab_lang)&&$i==$blab_lang){$sel=' selected="selected"';}else{$sel='';}
$the_lang=explode('.',$lang_files[$i]);$the_lang=ucfirst($the_lang[0]);
print '<option value="'.$i.'"'.$sel.'>'.$the_lang.'</option>';
}
?>
</select>
</td><td>&nbsp;&nbsp;&nbsp;</td></tr>
<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['timezone'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="offset">
<?php 
if(!isset($blab_time)){$blab_time=0;}
for($i=-12;$i<=13;$i++){if($i!=0){$gmt='';}else{$gmt=' GMT';}
if($i==$blab_time){$sel=' selected="selected"';}else{$sel='';}
$show_time=gmdate('Y-m-d H:i',time()+$i*3600);
print '<option value="'.$i.'"'.$sel.'>'.$show_time.$gmt.'</option>';}?></select>
</td><td></td></tr>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
</div></form></div>
<div class="z"></div>
</body></html>