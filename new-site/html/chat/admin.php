<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//


require_once 'config.php';
require_once 'incl/main.inc';
require_once('incl/upgrade.inc');

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}

if(!isset($my_details['usr_id'])||$my_details['usr_id']!='1'){
redirect('login.php?login=1',0,0);}

/* --- */

if(isset($badwords)&&is_writeable('badwords.txt')){
$bd_arr=explode(',',$badwords);

if(count($bd_arr)>1){
for($i=0;$i<count($bd_arr);$i++){
$bd_arr[$i]=trim($bd_arr[$i]);
if(strlen($bd_arr[$i])<2){$bd_arr[$i]='***';}}
$badwords=implode(',',$bd_arr);

$fd=fopen('badwords.txt',"w") or die();
$fout=fwrite($fd,$badwords);fclose($fd);}
redirect('admin.php?q=word',$lang['action_ok'],1);}

/* --- */

if(isset($uid)&&isset($name)&&isset($mail)&&isset($offset)&&isset($format)){
$uid=(int)$uid;
if($uid>1){

$offset=(int)$offset;
$format=(int)$format;
$name=neutral_escape($name,64,'str');
$mail=neutral_escape($mail,32,'str');

if(isset($location)){$location=neutral_escape($location,64,'str');}else{$location='';}
if(isset($website)){$website=neutral_escape($website,50,'str');}else{$website='';}
if(isset($avatar)){$avatar=neutral_escape($avatar,255,'str');}else{$avatar='';}
if(isset($info)){$info=neutral_escape($info,255,'str');}else{$info='';}
if(isset($sex)){$sex=(int)$sex;}else{$sex=0;}
if(isset($age)){$age=(int)$age;}else{$age=0;}
if(isset($snd)){$snd=(int)$snd;}else{$snd=0;}
if(isset($fun)){$fun=(int)$fun;}else{$fun=0;}

$query='UPDATE '.$prefix."_users SET 
usr_name='$name',usr_mail='$mail',usr_offset=$offset,usr_format=$format,usr_sex=$sex,usr_snd=$snd,usr_fun=$fun,usr_age=$age,usr_info='$info',usr_location='$location',usr_website='$website',usr_avatar='$avatar' WHERE usr_id=$uid";
neutral_query($query);
$link='admin.php?q=user&amp;uid='.$uid;
redirect($link,$lang['action_ok'],1);}}

/* --- */

if(isset($url)&&isset($mail)&&isset($title)){

$url=neutral_escape($url,50,'str');
if($url!=$settings['url']&&strlen($url)>9&&stristr($url,'http://')){
$query='UPDATE '.$prefix."_settings SET set_value='$url' WHERE set_id='url'";
neutral_query($query);}

$mail=neutral_escape($mail,50,'str');
if($mail!=$settings['default_mail']&&strlen($mail)>6&&stristr($mail,'@')&&stristr($mail,'.')){
$query='UPDATE '.$prefix."_settings SET set_value='$mail' WHERE set_id='default_mail'";
neutral_query($query);}

$title=neutral_escape($title,255,'str');
if($title!=$settings['title']){
$query='UPDATE '.$prefix."_settings SET set_value='$title' WHERE set_id='title'";
neutral_query($query);}


if(isset($activation)){
$activation=neutral_escape($activation,5,'str');}
else{$activation=output($settings['activation'],2);}

switch($activation){
case 'mail':$activation='mail';;break;
case 'admin':$activation='admin';break;
default:$activation='0';break;}

if($activation!=$settings['activation']){
$query='UPDATE '.$prefix."_settings SET set_value='$activation' WHERE set_id='activation'";
neutral_query($query);}

if(isset($suffix)){
$suffix=neutral_escape($suffix,6,'str');
if($suffix!=$settings['suffix']&&!strstr($suffix,'+')&&!strstr($suffix,'&')){
$query='UPDATE '.$prefix."_settings SET set_value=' $suffix' WHERE set_id='suffix'";
neutral_query($query);}}

if(isset($compression)){$compression=(int)$compression;
if($compression!=$settings['gzip']&&$compression<3){
$query='UPDATE '.$prefix."_settings SET set_value='$compression' WHERE set_id='gzip'";
neutral_query($query);}}

if(isset($max_users)){$max_users=(int)$max_users;
if($max_users!=$settings['max_users']){
$query='UPDATE '.$prefix."_settings SET set_value='$max_users' WHERE set_id='max_users'";
neutral_query($query);}}

if(isset($max_upload)){$max_upload=(int)$max_upload;
if($max_upload!=$settings['max_upload']){
$query='UPDATE '.$prefix."_settings SET set_value='$max_upload' WHERE set_id='max_upload'";
neutral_query($query);}}

if(isset($turing_number)){$turing_number=(int)$turing_number;
if($turing_number!=$settings['turing_number']&&$turing_number<2){
$query='UPDATE '.$prefix."_settings SET set_value='$turing_number' WHERE set_id='turing_number'";
neutral_query($query);}}

if(isset($turing_live)){$turing_live=(int)$turing_live;
if($turing_live!=$settings['turing_live']&&$turing_live>10){
$query='UPDATE '.$prefix."_settings SET set_value='$turing_live' WHERE set_id='turing_live'";
neutral_query($query);}}

if(isset($guest_pass)){
$guest_pass=neutral_escape($guest_pass,32,'str');
if($guest_pass!=$settings['guest_pass']&&strlen($guest_pass)>2){
$query='UPDATE '.$prefix."_settings SET set_value='$guest_pass' WHERE set_id='guest_pass'";
neutral_query($query);}}

if(isset($guest_name)){
$guest_name=neutral_escape($guest_name,32,'str');
if($guest_name!=$settings['guest_name']&&strlen($guest_name)>2){
$query='UPDATE '.$prefix."_settings SET set_value='$guest_name' WHERE set_id='guest_name'";
neutral_query($query);}}

if(isset($guest_help)){$guest_help=(int)$guest_help;
if($guest_help!=$settings['guest_help']&&$guest_help<2){
$query='UPDATE '.$prefix."_settings SET set_value='$guest_help' WHERE set_id='guest_help'";
neutral_query($query);}}

if(isset($reg_on)){$reg_on=(int)$reg_on;
if($reg_on!=$settings['reg_on']&&$reg_on<2){
$query='UPDATE '.$prefix."_settings SET set_value='$reg_on' WHERE set_id='reg_on'";
neutral_query($query);}}

redirect('admin.php?q=main',$lang['action_ok'],1);}

/* --- */

if(isset($v_message)&&isset($a_message)&&isset($p_message)&&isset($mail_header)&&isset($mail_footer)){

$v_message=neutral_escape($v_message,255,'txt');
if($v_message!=$settings['v_message']){
$query='UPDATE '.$prefix."_settings SET set_value='$v_message' WHERE set_id='v_message'";
neutral_query($query);}

$a_message=neutral_escape($a_message,255,'txt');
if($a_message!=$settings['a_message']){
$query='UPDATE '.$prefix."_settings SET set_value='$a_message' WHERE set_id='a_message'";
neutral_query($query);}

$p_message=neutral_escape($p_message,255,'txt');
if($p_message!=$settings['p_message']){
$query='UPDATE '.$prefix."_settings SET set_value='$p_message' WHERE set_id='p_message'";
neutral_query($query);}

$mail_header=neutral_escape($mail_header,255,'txt');
if($mail_header!=$settings['mail_header']){
$query='UPDATE '.$prefix."_settings SET set_value='$mail_header' WHERE set_id='mail_header'";
neutral_query($query);}

$mail_footer=neutral_escape($mail_footer,255,'txt');
if($mail_footer!=$settings['mail_footer']){
$query='UPDATE '.$prefix."_settings SET set_value='$mail_footer' WHERE set_id='mail_footer'";
neutral_query($query);}

redirect('admin.php?q=mail',$lang['action_ok'],1);}

/* --- */

if(isset($turn2mod)){
$turn2mod=(int)$turn2mod;
if($turn2mod>1){
$query='UPDATE '.$prefix."_users SET usr_mod=1 WHERE usr_id=$turn2mod";
neutral_query($query);
if(isset($from)){$from=(int)$from;}else{$from=0;}
if(isset($order)){$order=(int)$order;}else{$order=6;}
$link='admin.php?q=users&amp;from='.$from.'&amp;order='.$order;
redirect($link,$lang['action_ok'],1);}}

/* --- */

if(isset($activate)){
$activate=(int)$activate;
if($activate>1){

if(isset($from)){$from=(int)$from;}else{$from=0;}
if(isset($order)){$order=(int)$order;}else{$order=6;}
$link='admin.php?q=users&amp;from='.$from.'&amp;order='.$order;
$mssg=$lang['action_ok'];

if(isset($email)&&strstr($email,'@')&&strstr($email,'.')){
$settings['a_message']=str_replace('%URL%',$settings['url'],$settings['a_message']);
$mail_sent=send_mail($email,'',$settings['a_message'],$settings['default_mail']);}
else{$mail_sent=TRUE;}

if($mail_sent==TRUE){
$query='UPDATE '.$prefix."_users SET usr_status='0' WHERE usr_id=$activate";
neutral_query($query);}
else{$mssg=$lang['mail_error'];}

redirect($link,$mssg,1);}}

/* --- */

if(isset($suspend)){
$suspend=(int)$suspend;
if($suspend>1){

$query='UPDATE '.$prefix."_users SET usr_status='1' WHERE usr_id=$suspend";
neutral_query($query);

if(isset($from)){$from=(int)$from;}else{$from=0;}
if(isset($order)){$order=(int)$order;}else{$order=6;}
$link='admin.php?q=users&amp;from='.$from.'&amp;order='.$order;

redirect($link,$lang['action_ok'],1);}}

/* --- */

if(isset($empty)){
$empty=(int)$empty;
if($empty<1){$query='DELETE FROM '.$prefix.'_lines';}
else{$query='DELETE FROM '.$prefix."_lines WHERE room_id=$empty";}
neutral_query($query);
redirect('admin.php?q=rooms',$lang['action_ok'],1);}

/* --- */

if(isset($mass)){
$mass=(int)$mass;
switch($mass){
case 1: $query='UPDATE '.$prefix."_users SET usr_status='0' WHERE usr_status<>'1' AND usr_status<>'0'";break;
case 2: $query='UPDATE '.$prefix."_users SET usr_status='0' WHERE usr_status='1'";break;
case 3: $query='DELETE FROM '.$prefix."_users WHERE usr_status<>'1' AND usr_status<>'0'";break;
case 4: $query='DELETE FROM '.$prefix."_users WHERE usr_status='1'";break;
case 5: $query='UPDATE '.$prefix."_users SET usr_mod=0 WHERE usr_id>1 AND usr_mod=1";break;
default:$query='DELETE FROM '.$prefix.'_banned';break;}

neutral_query($query);
redirect('admin.php?q=users',$lang['action_ok'],1);}

/* --- */

if(isset($turn2usr)){
$turn2usr=(int)$turn2usr;
if($turn2usr>1){
$query='UPDATE '.$prefix."_users SET usr_mod=0 WHERE usr_id=$turn2usr";
neutral_query($query);

if(isset($from)){$from=(int)$from;}else{$from=0;}
if(isset($order)){$order=(int)$order;}else{$order=6;}
$link='admin.php?q=users&amp;from='.$from.'&amp;order='.$order;

redirect($link,$lang['action_ok'],1);}}

/* --- */

if(isset($del_room)){
$del_room=(int)$del_room;
if($del_room>1){
$query='DELETE FROM '.$prefix."_rooms WHERE room_id=$del_room";
neutral_query($query);
redirect('admin.php?q=rooms',$lang['action_ok'],1);}}

/* --- */

if(isset($del_user)){
$del_user=(int)$del_user;
if($del_user>1){
$query='DELETE FROM '.$prefix."_users WHERE usr_id=$del_user";
neutral_query($query);

if(isset($from)){$from=(int)$from;}else{$from=0;}
if(isset($order)){$order=(int)$order;}else{$order=6;}
$link='admin.php?q=users&amp;from='.$from.'&amp;order='.$order;

redirect($link,$lang['action_ok'],1);}}

/* --- */

if(isset($new_room)){
$new_room=neutral_escape($new_room,64,'str');
$new_room=str_replace("'",'',$new_room);

if(strlen($new_room)>0){
$query='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'$new_room','No description...',0)";
neutral_query($query);
redirect('admin.php?q=rooms',$lang['action_ok'],1);}}

/* --- */

if(isset($room_id)&&isset($room_name)&&isset($room_desc)){
$room_id=(int)$room_id;
$room_name=neutral_escape($room_name,64,'str');
$room_desc=neutral_escape($room_desc,255,'str');
if(strlen($room_name)>0){
$query='UPDATE '.$prefix."_rooms SET room_name='$room_name',room_desc='$room_desc' WHERE room_id=$room_id";
neutral_query($query);
redirect('admin.php?q=rooms',$lang['action_ok'],1);}}

/* --- */

// actions

/* --- */

if(!isset($q)){$q='0';}
include 'incl/open_doc.inc';
?>

<div class="x"><div style="float:right"><?php include 'banner.html';?></div>
<div style="float:left;margin:5px;white-space:nowrap">
<a href="info.php?reason=link" onclick="go('admin.php');return false"><?php if($my_details['usr_id']==1){$pic=show_pic($navi['admin'],0);print $pic;}?></a>
<a href="info.php?reason=link" onclick="go('blab.php');return false"><?php $pic=show_pic($navi['rooms'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="go('profile.php');return false"><?php $pic=show_pic($navi['profl'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="go('login.php');return false"><?php $pic=show_pic($navi['exitt'],0);print $pic;?></a>
</div></div>

<div class="y3">
<div style="width:350px;margin:auto">
<?php

switch($q){
case 'rooms':require_once 'incl/a_rooms.inc';break;
case 'users':require_once 'incl/a_users.inc';break;
case 'room':require_once 'incl/a_room.inc';break;
case 'user':require_once 'incl/a_user.inc';break;
case 'mail':require_once 'incl/a_mail.inc';break;
case 'word':require_once 'incl/a_badwords.inc';break;
case 'main':require_once 'incl/a_main.inc';break;
default:require_once 'incl/a_rooms.inc';break;
}

?>
<div class="s" style="text-align:right;padding-top:2px">
<a class="u" href="info.php?reason=link" onclick="return go('admin.php?q=main')" style="text-decoration:none;font-weight:bold"><?php print $lang['settings'];?></a> <b>&middot;</b>
<a class="u" href="info.php?reason=link" onclick="return go('admin.php?q=rooms')" style="text-decoration:none;font-weight:bold"><?php print $lang['rooms'];?></a> <b>&middot;</b>
<a class="u" href="info.php?reason=link" onclick="return go('admin.php?q=users')" style="text-decoration:none;font-weight:bold"><?php print $lang['users'];?></a>
</div><div class="s">&nbsp;</div>
</div></div><div class="z"></div></body></html>