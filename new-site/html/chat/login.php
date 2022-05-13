<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$error_message='';

if((isset($blab_id)||isset($blab_pass))&&!headers_sent()){
setcookie('blab_id','',$timestamp,'/');
setcookie('blab_pass','',$timestamp,'/');
redirect('login.php?logout=1',0,0);}

elseif(isset($name)&&isset($pass)){

if(!isset($language)){$language=0;}$language=(int)$language;
if(!isset($offset)){$offset=0;}$offset=(int)$offset;

$name=neutral_escape($name,32,'str');
$pass=neutral_escape($pass,64,'str');

if(strlen($name)>2&&strlen($pass)>2){
include 'incl/turing_check.inc';

if($turing_ok=='1'){

if($name==$settings['guest_name']&&$pass==$settings['guest_pass']&&!headers_sent()){
$pass=hsh($settings['guest_pass']);
setcookie('blab_id','0',time()+3600*24,'/');
setcookie('blab_pass',$pass,time()+3600*24,'/');
setcookie('blab_lang',$language,time()+3600*24*365,'/');
setcookie('blab_time',$offset,time()+3600*24*365,'/');
redirect('blab.php',0,0);}

$pass=hsh($pass);
$query="SELECT usr_id,usr_lng FROM ".$prefix."_users WHERE usr_name='$name' AND usr_pass='$pass' AND usr_status='0'";
$result=neutral_query($query);
$my_details=neutral_fetch_array($result);

if(neutral_num_rows($result)>0){
if(!headers_sent()){
$encid_cookie=$my_details['usr_id'].'-'.hsh($my_details['usr_id'].$settings['random']);

if(isset($remember_me)&&$remember_me>0){
$remember_me=(int)$remember_me;
$remember_me=time()+3600*24*$remember_me;}
else{$remember_me=time()+6*3600;}

setcookie('blab_id',$encid_cookie,$remember_me,'/');
setcookie('blab_pass',$pass,$remember_me,'/');
setcookie('blab_lang',$language,time()+3600*24*365,'/');
setcookie('blab_time',$offset,time()+3600*24*365,'/');
redirect('blab.php',0,0);

}else{$error_message=$lang['headers_sent'];}
}else{$error_message=$lang['wrong'];}
}else{$error_message=$lang['wrong_turing'];}
}else{$error_message=$lang['wrong'];}}

include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<div style="width:290px;margin:auto">
<form action="login.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return check_log('<?php print $lang['all_req'];?>')">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4">
<div id="emms" class="s" style="float:right"><?php print $error_message;?></div>
<div style="float:left" class="u"><?php print $lang['login'];?></div></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>
<tr class="c"><td>&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['name'];?>:</span></td>
<td class="c"><input size="25" type="text" maxlength="16" name="name" value="<?php if($settings['guest_help']=='1'){output($settings['guest_name'],1);}?>" onfocus="if(this.value=='<?php if($settings['guest_help']=='1'){output($settings['guest_name'],1);}?>'){this.value='';}" /></td>
<td class="c">&nbsp;</td></tr><tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['password'];?>:</span></td>
<td class="c"><input size="25" type="password" maxlength="32" name="pass" value="<?php if($settings['guest_help']=='1'){output($settings['guest_pass'],1);print ' ';}?>" onfocus="if(this.value=='<?php if($settings['guest_help']=='1'){output($settings['guest_pass'],1);print ' ';}?>'){this.value='';}"/></td>
<td></td></tr>
<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['remember'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="remember_me">
<option value="0"><?php print $lang['6_hours'];?></option>
<option value="1" selected="selected"><?php print $lang['a_day'];?></option>
<option value="7"><?php print $lang['a_week'];?></option>
<option value="30"><?php print $lang['a_month'];?></option>
<option value="365"><?php print $lang['a_year'];?></option>
</select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['lang'];?>:</span></td>
<td class="c">
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
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['timezone'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="offset">
<?php 
if(!isset($blab_time)){$blab_time=$timezone;}
for($i=-12;$i<=13;$i++){if($i!=0){$gmt='';}else{$gmt=' GMT';}
if($i==$blab_time){$sel=' selected="selected"';}else{$sel='';}
$show_time=gmdate('Y-m-d H:i',time()+$i*3600);
print '<option value="'.$i.'"'.$sel.'>'.$show_time.$gmt.'</option>';}?></select>
</td><td></td></tr>

<?php if(function_exists('imagecolorallocate')&&function_exists('imagecreate')&&function_exists('imagettftext')&&$settings['turing_number']=='1'&&is_writeable('turing_number.png')){
$del_time=$timestamp-($settings['turing_live']*60);
$query='DELETE FROM '.$prefix."_tnumber WHERE tur_stamp<$del_time";
neutral_query($query);include 'incl/turing_set.inc';}?>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
<div class="s" style="text-align:right">
<?php 
if(isset($settings['reg_on'])&&$settings['reg_on']=='1'){
print '<a class="u" href="info.php?reason=link" onclick="return go(\'register.php\')" style="font-weight:bold">'.$lang['register'].'</a>&nbsp;';
print '<a class="u" href="info.php?reason=link" onclick="return go(\'password.php\')" style="font-weight:bold">'.$lang['password'].'</a>';
}?>
</div>
</form></div></div>
<div class="z"></div></body></html>