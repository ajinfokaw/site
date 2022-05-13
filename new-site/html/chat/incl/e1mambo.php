<?php
$u='username';$p='password';

if(isset($usercookie[$u])&&isset($usercookie[$p])){
$mos_name=neutral_escape($usercookie[$u],32,'str');
$query="SELECT id,username,password FROM $ext1tble WHERE username='$mos_name'";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){
$mos_user=neutral_fetch_array($result);

if($mos_user['password']==$usercookie[$p]){

$mos_user['id']=(int)$mos_user['id'];
$my_details['usr_id']=500000000+$mos_user['id'];

$mos_user['username']=convert_enc($mos_user['username']);

$my_details['usr_name']=$mos_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone='0';
}}}

?>