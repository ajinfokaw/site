<?php

$punnbb_seed='62fb5c06';
$punbb_user=array();

if(isset($$ext1cook)){

$cookie=stripslashes(urldecode($$ext1cook));
$cookie=unserialize($cookie);

if(isset($cookie[1])){

$userid=(int)$cookie[0];
$usrpss=$cookie[1];

$query="SELECT id,username,password,timezone FROM $ext1tble WHERE id=$userid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){

$punbb_user=neutral_fetch_array($result);

if($usrpss==md5($punnbb_seed.$punbb_user['password'])){
$punbb_user['id']=(int)$punbb_user['id'];
$my_details['usr_id']=500000000+$punbb_user['id'];

$punbb_user['username']=convert_enc($punbb_user['username']);

$my_details['usr_name']=$punbb_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$punbb_user['timezone'];
}}}}
?>