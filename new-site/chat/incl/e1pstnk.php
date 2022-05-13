<?php

if(isset($$ext1cook)){

$sessn=neutral_escape($$ext1cook,64,'str');

$query="SELECT pn_uid FROM $ext2tble WHERE pn_sessid='$sessn'";
$result=neutral_query($query);$pointer=neutral_fetch_array($result);
$pointer=(int)$pointer[0];

$query="SELECT pn_uid,pn_uname,pn_timezone_offset FROM $ext1tble WHERE pn_uid=$pointer";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$ppost_user=neutral_fetch_array($result);

$ppost_user['pn_uid']=(int)$ppost_user['pn_uid'];
$my_details['usr_id']=500000000+$ppost_user['pn_uid'];

$ppost_user['pn_uname']=convert_enc($ppost_user['pn_uname']);

$my_details['usr_name']=$ppost_user['pn_uname'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$ppost_user['pn_timezone_offset']-12;

}}
?>