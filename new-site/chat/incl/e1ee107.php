<?php

if(isset($$ext1cook)){

$cookie=explode('.',$$ext1cook);
$id=(int)$cookie[0];
$query="SELECT user_id,user_name,user_password,user_timezone FROM $ext1tble WHERE user_id=$id";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$e107_user=neutral_fetch_array($result);

if(md5($e107_user['user_password'])==$cookie[1]){

$e107_user['user_id']=(int)$e107_user['user_id'];
$my_details['usr_id']=500000000+$e107_user['user_id'];

$e107_user['user_name']=convert_enc($e107_user['user_name']);

$my_details['usr_name']=$e107_user['user_name'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$e107_user['user_timezone'];

}}}

?>