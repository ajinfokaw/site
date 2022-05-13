<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($settings['reg_on']) || $settings['reg_on']!='1'){redirect('../',0,0);}

$error_message='';
if(isset($blab_id)||isset($blab_pass)){redirect('login.php',0,0);}

if(isset($mail)){
include 'incl/turing_check.inc';
if($turing_ok=='1'){

$mail=neutral_escape($mail,32,'str');
if(strlen($mail)>6&&stristr($mail,'@')&&stristr($mail,'.')){

$query='SELECT usr_id,usr_mail FROM '.$prefix."_users WHERE usr_mail='$mail'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$result=neutral_fetch_array($result);

$new_pass='';
$alphabet='abcdefghijklmnopqrstuvwxyz1234567890';
for($i=0;$i<8;$i++){$new_pass.=$alphabet[(mt_rand(0,(strlen($alphabet)-1)))];}
$store_pass=hsh($new_pass);

$url=$settings['url'].'/login.php';
$settings['p_message']=str_replace('%PASSWORD%',$new_pass,$settings['p_message']);
$settings['p_message']=str_replace('%URL%',$url,$settings['p_message']);

$mail_sent=send_mail($mail,'',$settings['p_message'],$settings['default_mail']);

if($mail_sent==TRUE){

$query="UPDATE ".$prefix."_users SET usr_pass='$store_pass' WHERE usr_mail='$mail'";
neutral_query($query);

redirect('login.php',$lang['check_inbox'],1);

}else{$error_message=$lang['mail_error'];}
}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong_turing'];}}

include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<div style="width:290px;margin:auto">
<form action="password.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return check_fps('<?php print $lang['all_req'];?>')">
<table style="width:100%" cellspacing="0" class="a">
<tr>
<td class="b" colspan="4">
<div id="emms" class="s" style="float:right"><?php print $error_message;?></div>
<div style="float:left" class="u"><?php print $lang['forgot_pass'];?></div></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>
<tr class="c"><td>&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['mail'];?>:</span></td>
<td class="c"><input size="25" type="text" maxlength="32" name="mail" value="" /></td>
<td class="c">&nbsp;</td></tr>

<?php if(function_exists('imagecolorallocate')&&function_exists('imagecreate')&&function_exists('imagettftext')&&$settings['turing_number']=='1'&&is_writeable('turing_number.png')){
$del_time=$timestamp-($settings['turing_live']*60);
$query='DELETE FROM '.$prefix."_tnumber WHERE tur_stamp<$del_time";
neutral_query($query);include 'incl/turing_set.inc';}?>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
<div class="s" style="text-align:right">
<a class="u" href="info.php?reason=link" onclick="return go('login.php')" style="font-weight:bold"><?php print $lang['login'];?></a>
<a class="u" href="info.php?reason=link" onclick="return go('register.php')" style="font-weight:bold"><?php print $lang['register'];?></a>
</div>
</form></div></div>
<div class="z"></div>
</body></html>