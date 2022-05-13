<?php

$phpbb_user=array();
if(isset($$ext1cook)){

$cookie=stripslashes(urldecode($$ext1cook));
$cookie=unserialize($cookie);

if(isset($cookie['autologinid'])&&isset($cookie['userid'])){

$userid=(int)$cookie['userid'];
$usrpss=md5($cookie['autologinid']);

$query="SELECT a.user_id,a.username,a.user_timezone,b.key_id FROM $ext1tble a,$ext2tble b WHERE b.key_id='$usrpss' AND a.user_id=b.user_id AND a.user_id=$userid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$phpbb_user=neutral_fetch_array($result);
$phpbb_user['user_id']=(int)$phpbb_user['user_id'];
$my_details['usr_id']=500000000+$phpbb_user['user_id'];

$phpbb_user['username']=convert_enc($phpbb_user['username']);

$my_details['usr_name']=$phpbb_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$phpbb_user['user_timezone'];
}}}
?>