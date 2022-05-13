<?php
require_once 'config.php';
require_once 'incl/main.inc';

$error_message='';
if(isset($blab_id)||isset($blab_pass)){redirect('login.php',0,0);}

if(isset($vcode)){
include 'incl/turing_check.inc';
if($turing_ok=='1'){

$vcode=neutral_escape($vcode,8,'str');
if(strlen($vcode)==8){

$query='SELECT usr_id FROM '.$prefix."_users WHERE usr_status='$vcode'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){

$query='UPDATE '.$prefix."_users SET usr_status='0' WHERE usr_status='$vcode'";

$result=neutral_query($query);
redirect('login.php',$lang['account_ok'],1);

}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong_turing'];}
}

include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<div style="width:290px;margin:auto">
<form action="verify.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return check_ver('<?php print $lang['all_req'];?>')">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4">
<div id="emms" class="s" style="float:right"><?php print $error_message;?></div>
<div style="float:left" class="u"><?php print $lang['verification'];?></div></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>
<tr class="c"><td>&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['code'];?>:</span></td>
<td class="c"><input size="25" type="text" name="vcode" maxlength="8" value="<?php if(isset($q)){output($q,1);}?>" /></td>
<td class="c">&nbsp;</td></tr>

<?php if(function_exists('imagecolorallocate')&&function_exists('imagecreate')&&function_exists('imagettftext')&&$settings['turing_number']=='1'&&is_writeable('turing_number.png')){
$del_time=$timestamp-($settings['turing_live']*60);
$query='DELETE FROM '.$prefix."_tnumber WHERE tur_stamp<$del_time";
neutral_query($query);include 'incl/turing_set.inc';}?>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
</form></div></div>
<div class="z"></div>
</body></html>