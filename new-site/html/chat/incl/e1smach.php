<?php

function md5_hmac($data,$key){
$key = str_pad(strlen($key) <= 64 ? $key : pack('H*', md5($key)), 64, chr(0x00));
return md5(($key ^ str_repeat(chr(0x5c), 64)) . pack('H*', md5(($key ^ str_repeat(chr(0x36), 64)). $data)));}

if(isset($$ext1cook)){

$cookie=stripslashes(urldecode($$ext1cook));
$arr=unserialize($cookie);

if(isset($arr[0])&&isset($arr[1])){

$userid=(int)$arr['0'];

$query="SELECT ID_MEMBER,memberName,passwd,timeOffset FROM $ext1tble WHERE ID_MEMBER=$userid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$sm_user=neutral_fetch_array($result);

$pass=md5_hmac($sm_user['passwd'],'ys');

if($pass==$arr['1']){

$sm_user['ID_MEMBER']=(int)$sm_user['ID_MEMBER'];
$my_details['usr_id']=500000000+$sm_user['ID_MEMBER'];

$sm_user['memberName']=convert_enc($sm_user['memberName']);

$my_details['usr_name']=$sm_user['memberName'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$sm_user['timeOffset'];

}}}}
?>