<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}

if(!isset($my_details['usr_id'])){redirect('login.php?login=1',0,0);}

if(isset($offset)&&isset($format)){

$old_pass=output($my_details['usr_pass'],2);
$old_mail=output($my_details['usr_mail'],2);
$link='blab.php';
$mmsg=$lang['action_ok'];
$verification='0';

$offset=(int)$offset;
$format=(int)$format;

$bad_words=file('badwords.txt');
$bad_words=explode(',',$bad_words[0]);

if(isset($location)){$location=neutral_escape($location,64,'str');}else{$location='';}
if(isset($website)){$website=neutral_escape($website,50,'str');}else{$website='';}
if(isset($oass)){$oass=neutral_escape($oass,64,'str');}
if(isset($pass)){$pass=neutral_escape($pass,64,'str');}
if(isset($cass)){$cass=neutral_escape($cass,64,'str');}
if(isset($mail)){$mail=neutral_escape($mail,32,'str');}
if(isset($avatar)){$avatar=neutral_escape($avatar,255,'str');}else{$avatar='';}
if(isset($info)){$info=neutral_escape($info,255,'str');}else{$info='';}
if(isset($sex)){$sex=(int)$sex;}else{$sex=0;}
if(isset($age)){$age=(int)$age;}else{$age=0;}
if(isset($snd)){$snd=(int)$snd;}else{$snd=0;}
if(isset($fun)){$fun=(int)$fun;}else{$fun=0;}

if(count($bad_words)>1){for($i=0;$i<count($bad_words);$i++){
$info=eregi_replace($bad_words[$i],'***',$info);}}

if(count($bad_words)>1){for($i=0;$i<count($bad_words);$i++){
$location=eregi_replace($bad_words[$i],'***',$location);}}

if(isset($language)){
$language=neutral_escape($language,3,'int');}else{$language=0;}
if(!headers_sent()){
setcookie('blab_lang',$language,time()+3600*24*365,'/');
setcookie('blab_time',$offset,time()+3600*24*365,'/');}

if(strlen($avatar)<9 || stristr($avatar,'"') || stristr($avatar,"'") || stristr($avatar,'script') ){$avatar='';}
if(strlen($website)<9||!stristr($website,'http://')){$website='';}
if(strlen($location)<2){$location='';}

if(isset($oass)&&strlen($oass)>2&&hsh($oass)==$old_pass&&isset($pass)&&isset($cass)&&$pass==$cass&&strlen($pass)>2&&$mail==$old_mail){
$the_pass=$pass=hsh($pass);$link='login.php?logout=1';}
else{$the_pass=neutral_escape($old_pass,32,'str');}

if(isset($mail)&&strlen($mail)>6&&$mail!=$old_mail&&stristr($mail,'@')&&stristr($mail,'.')&&strlen($pass)<3){

$mail=neutral_escape($mail,32,'str');
$mail=strtolower($mail);

$verification=substr(hsh($mail.$settings['random']),0,8);
$verify_url=$settings['url'].'/verify.php?q='.$verification;

switch($settings['activation']){
case 'mail'  :$link='login.php?logout=1';$mmsg=$lang['check_inbox'];

              $settings['v_message']=str_replace('%URL%',$verify_url,$settings['v_message']);
              $settings['v_message']=str_replace('%CODE%',$verification,$settings['v_message']);
              $mail_sent=send_mail($mail,'',$settings['v_message'],$settings['default_mail']);break;

case 'admin' :$link='login.php?logout=1';$mail_sent=TRUE;break;
default      :$mail_sent=TRUE;$verification='0';break;}

if($mail_sent!=TRUE){redirect('profile.php',$lang['mail_error'],1);}
}
else{$mail=neutral_escape($old_mail,32,'str');}

$id=(int)$my_details['usr_id'];
$query='UPDATE '.$prefix."_users SET usr_pass='$the_pass',usr_mail='$mail',usr_offset=$offset,usr_format=$format,usr_sex=$sex,usr_snd=$snd,usr_fun=$fun,usr_age=$age,usr_lng=$language,usr_info='$info',usr_location='$location',usr_website='$website',usr_avatar='$avatar',usr_status='$verification' WHERE usr_id=$id";
neutral_query($query);
redirect($link,$mmsg,1);

}


include 'incl/open_doc.inc';
?>
<div id="dvx" class="x">
<div style="float:right"><?php include 'banner.html';?></div>
<div style="float:left;margin:5px;white-space:nowrap">
<a href="info.php?reason=link" onclick="go('admin.php');return false"><?php if($my_details['usr_id']==1){$pic=show_pic($navi['admin'],0);print $pic;}?></a>
<a href="info.php?reason=link" onclick="go('blab.php');;return false"><?php $pic=show_pic($navi['rooms'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="go('profile.php');return false"><?php $pic=show_pic($navi['profl'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="go('login.php');return false"><?php $pic=show_pic($navi['exitt'],0);print $pic;?></a>
</div><br style="clear:both" /></div>

<div class="y3">
<div style="width:310px;margin:auto">
<form action="profile.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return check_pro()">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4"><span class="u"><?php output($my_details['usr_name'],1);?></span></td></tr>

<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>

<tr class="c"><td class="c">&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['mail'];?>:</span></td>
<td class="c"><input size="25" type="text" maxlength="32" name="mail" value="<?php output($my_details['usr_mail'],1);?>" onkeyup="document.getElementById('infm').style.display='block'" />
<div id="infm" style="padding-top:4px;display:none" class="s"><?php if($settings['activation']!='0'){print $lang['revalidate'];}?></div></td>
<td class="c">&nbsp;</td></tr>

<tr class="c"><td></td>
<td class="c" style="white-space:nowrap;text-align:right"><span class="s"><?php print $lang['old_pass'];?>:</span></td>
<td class="c"><input size="25" type="password" maxlength="32" name="oass" value="" /></td>
<td></td></tr>

<tr class="c"><td></td>
<td class="c" style="white-space:nowrap;text-align:right"><span class="s"><?php print $lang['new_pass'];?>:</span></td>
<td class="c">
<div style="float:left"><input style="width:75px" type="password"  maxlength="32" name="pass" value="" /></div>
<div style="float:right"><input style="width:75px" type="password" maxlength="32" name="cass" value="" /></div>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['timezone'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="offset">
<?php 

switch($my_details['usr_format']){
case '1':$format='h:i:s A';break;
case '2':$format='Y-m-d H:i:s';break;
case '3':$format='d.m.Y H:i:s';break;
case '4':$format='m/d/Y h:i:s A';break;
default:$format='H:i:s';break;}


for($i=-12;$i<=13;$i++){
if($i!=0){$gmt='';}else{$gmt=' GMT';}
if($i==$my_details['usr_offset']){$sel=' selected="selected"';}else{$sel='';}
$show_time=gmdate($format,time()+$i*3600);

print '<option value="'.$i.'"'.$sel.'>'.$show_time.$gmt.'</option>';}?></select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['time_format'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="format">
<?php
$show_time=gmdate('H:i:s',time()+$my_details['usr_offset']*3600);
if($my_details['usr_format']==0){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('Y-m-d H:i:s',time()+$my_details['usr_offset']*3600);
if($my_details['usr_format']=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('d.m.Y H:i:s',time()+$my_details['usr_offset']*3600);
if($my_details['usr_format']=='3'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="3"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('m/d/Y h:i:s A',time()+$my_details['usr_offset']*3600);
if($my_details['usr_format']=='4'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="4"'.$sel.'>'.$show_time.'</option>';

$show_time=gmdate('h:i:s A',time()+$my_details['usr_offset']*3600);
if($my_details['usr_format']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$show_time.'</option>';
?>
</select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['lang'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="language">
<?php

require_once 'lang/languages.inc';
for($i=0;$i<count($lang_files);$i++){
if($i==$my_details['usr_lng']){$sel=' selected="selected"';}else{$sel='';}
$the_lang=explode('.',$lang_files[$i]);$the_lang=ucfirst($the_lang[0]);
print '<option value="'.$i.'"'.$sel.'>'.$the_lang.'</option>';
}
?>
</select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['sex'].'/'.$lang['age'];?>:</span></td><td class="c">
<div style="float:left">
<select style="width:75px;font-size:10px" name="sex">
<?php
if($my_details['usr_sex']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>&nbsp;</option>';
if($my_details['usr_sex']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['male'].'</option>';
if($my_details['usr_sex']=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$lang['female'].'</option>';
?>
</select></div>
<div style="float:right">
<select style="width:75px;font-size:10px" name="age">
<option value="0">&nbsp;</option>
<?php

$current=gmdate('Y',time());
$start_i=$current-80;
$end_i=$current-10;

for($i=$start_i;$i<$end_i;$i++){
if($my_details['usr_age']==$i){$sel=' selected="selected"';}else{$sel='';}
print '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
?>
</select></div>
</td><td></td></tr>


<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['sound'].'/'.$lang['fun'];;?>:</span></td>
<td class="c">
<div style="float:left">
<select style="width:75px;font-size:10px" name="snd">
<?php
if($my_details['usr_snd']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($my_details['usr_snd']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
?>
</select></div>
<div style="float:right">
<select style="width:75px;font-size:10px" name="fun">
<?php
if($my_details['usr_fun']=='0'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="0"'.$sel.'>'.$lang['off'].'</option>';
if($my_details['usr_fun']=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['on'].'</option>';
?>
</select></div>
</td><td></td></tr>


<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['location'];?>:</span></td>
<td class="c"><input size="25" type="text" name="location" maxlength="32" value="<?php output($my_details['usr_location'],1);?>" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['website'];?>:</span></td>
<td class="c"><input size="25" type="text" name="website" maxlength="50" value="<?php output($my_details['usr_website'],1);?>" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['info'];?>:</span></td>
<td class="c"><textarea name="info" cols="20" rows="5" style="width:100%;overflow:auto" onkeyup="if(this.value.length>127){this.value=this.value.substr(0,127)}"><?php output($my_details['usr_info'],1);?></textarea></td>
<td class="c"></td></tr>

<tr class="c"><td></td><td valign="top" rowspan="3">
<?php
$path='';$pic='incl/no_pic.png';
if(strlen($my_details['usr_avatar'])>10){
$pic=output($my_details['usr_avatar'],2);
$path=escape($pic);}$current=escape($pic);
print '<script type="text/javascript">current_path=\''.$current.'\';</script>';

?>
<img id="avtr" src="<?php print $pic;?>" class="i" style="float:right;width:60px;height:60px;padding:1px;border:1px solid" alt="" />
</td><td class="c"><span class="s"><b>
<a href="info.php?reason=link" onclick="win=window.open('avatar.php','wwn','width=340,height=270,resizable=1,scrollbars=1');win.focus();return false"><?php print $lang['choose'];?></a> &middot;
<a href="info.php?reason=link" onclick="win=window.open('upload.php','wwn','width=220,height=150,resizable=1,scrollbars=1');win.focus();return false"><?php if($settings['max_upload']>5){print $lang['upload'];}?></a> &middot;
<a href="info.php?reason=link" onclick="pc=prompt('URL','http://');if(pc){if(pc.length>7){document.forms.fms.avatar.value=pc;document.getElementById('avtr').src=pc}else{document.forms.fms.avatar.value='';document.getElementById('avtr').src='incl/no_pic.png'}}return false">URL</a>
</b></span></td><td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c"><input size="25" type="text" name="avatar" maxlength="255" value="<?php print $path;?>" readonly="readonly" /></td>
<td class="c"></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right">
<input type="reset" onclick="document.getElementById('avtr').src=current_path;document.getElementById('infm').style.display='none'" value="<?php print $lang['reset'];?>" />
<input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
</form></div></div>
<div class="z"></div>
</body></html>