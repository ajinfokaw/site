<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($settings['reg_on']) || $settings['reg_on']!='1'){redirect('../',0,0);}

$error_message='';
if(isset($blab_id)||isset($blab_pass)){redirect('login.php',0,0);}

if(isset($name)&&isset($pass)&&isset($mail)&&isset($cass)){

$bad_words=file('badwords.txt');
$bad_words=explode(',',$bad_words[0]);

$name=neutral_escape($name,32,'str');
if(stristr($name,$settings['guest_name'])){$name='';}
if(stristr($name,$settings['suffix'])){$name='';}
$pass=neutral_escape($pass,64,'str');
$cass=neutral_escape($cass,64,'str');
$mail=neutral_escape($mail,32,'str');

if(count($bad_words)>1){for($i=0;$i<count($bad_words);$i++){
if(stristr($name,$bad_words[$i])){$name='';}}}


if(strlen($name)>2&&strlen($pass)>2&&strlen($mail)>6&&$pass==$cass&&stristr($mail,'@')&&stristr($mail,'.')){
include 'incl/turing_check.inc';

if($turing_ok=='1'){

$query='SELECT usr_id FROM '.$prefix."_users WHERE usr_name='$name' OR usr_mail='$mail'";
$result=neutral_query($query);

if(neutral_num_rows($result)<1){

if(isset($offset)){$offset=(int)$offset;}else{$offset='0';}
if(isset($language)){$language=(int)$language;}else{$language='0';}
$mail=strtolower($mail);$pass=hsh($pass);

$verification=substr(hsh($mail.$settings['random']),0,8);
$verify_url=$settings['url'].'/verify.php?q='.$verification;

switch($settings['activation']){
case 'mail'  :$go_to=0;$msg=$lang['check_inbox'];

              $settings['v_message']=str_replace('%URL%',$verify_url,$settings['v_message']);
              $settings['v_message']=str_replace('%CODE%',$verification,$settings['v_message']);
              $mail_sent=send_mail($mail,'',$settings['v_message'],$settings['default_mail']);break;

case 'admin' :$go_to='login.php';$msg=$lang['wait_app'];$mail_sent=TRUE;break;
default      :$go_to='login.php';$msg=$lang['account_ok'];$verification='0';$mail_sent=TRUE;break;}

if($mail_sent==TRUE){
$query='INSERT INTO '.$prefix."_users VALUES($autoinc,'$name','$pass','$mail',$timestamp,0,0,0,1,1,0,$language,0,'','','','','$verification')";
neutral_query($query);
redirect($go_to,$msg,1);

}else{$error_message=$lang['mail_error'];}
}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong_turing'];}
}else{$error_message=$lang['wrong'];}}

include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<form action="register.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return check_reg('<?php print $lang['all_req'];?>')">
<div style="width:290px;margin:auto">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4">
<div id="emms" class="s" style="float:right"><?php print $error_message;?></div>
<div style="float:left" class="u"><?php print $lang['register'];?></div></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>
<tr class="c"><td>&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['name'];?>:</span></td>
<td class="c"><input size="25" type="text" name="name" maxlength="16" value="" /></td>
<td class="c">&nbsp;</td></tr>
<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['password'];?>:</span></td>
<td class="c"><input size="25" type="password"  maxlength="32" name="pass" value="" /></td>
<td class="c"></td></tr>
<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['retype'];?>:</span></td>
<td class="c"><input size="25" type="password"  maxlength="32" name="cass" value="" /></td>
<td class="c"></td></tr>
<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['mail'];?>:</span></td>
<td class="c"><input size="25" type="text" maxlength="32" name="mail" value="" /></td>
<td></td></tr>

<?php if(function_exists('imagecolorallocate')&&function_exists('imagecreate')&&function_exists('imagettftext')&&$settings['turing_number']=='1'&&is_writeable('turing_number.png')){
$del_time=$timestamp-($settings['turing_live']*60);
$query='DELETE FROM '.$prefix."_tnumber WHERE tur_stamp<$del_time";
neutral_query($query);include 'incl/turing_set.inc';}?>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
<div class="s" style="text-align:right">
<input type="hidden" name="language" value="<?php if(isset($blab_lang)){$blab_lang=(int)$blab_lang;print $blab_lang;}else{print '0';}?>" />
<input type="hidden" name="offset" value="<?php if(isset($blab_time)){$blab_time=(int)$blab_time;print $blab_time;}else{print '0';}?>" />
<a class="u" href="info.php?reason=link" onclick="return go('login.php')" style="font-weight:bold"><?php print $lang['login'];?></a>
<a class="u" href="info.php?reason=link" onclick="return go('password.php')" style="font-weight:bold"><?php print $lang['password'];?></a>
</div></div>
</form><br /><br /></div>
<div class="z"></div>
</body></html>