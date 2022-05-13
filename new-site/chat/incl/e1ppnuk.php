<?php

if(isset($$ext1cook)){

$user=base64_decode($$ext1cook);
$user=explode(":",$user);
if(isset($user[2])){
$user[1]=neutral_escape($user[1],64,'str');

$query="SELECT user_id,username,user_password,user_timezone FROM $ext1tble WHERE username='$user[1]'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$ppnuke_user=neutral_fetch_array($result);

if($ppnuke_user['user_password']==$user[2]){

$ppnuke_user['user_id']=(int)$ppnuke_user['user_id'];
$my_details['usr_id']=500000000+$ppnuke_user['user_id'];

$ppnuke_user['username']=convert_enc($ppnuke_user['username']);

$my_details['usr_name']=$ppnuke_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$ppnuke_user['user_timezone'];


}}}}

?>