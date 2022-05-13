<?php

if(isset($$ext1cook)&&isset($$ext2cook)){
$member_id=(int)$$ext1cook;
$query="SELECT id,name,member_login_key,time_offset FROM $ext1tble WHERE id=$member_id";

$result=neutral_query($query);
if(neutral_num_rows($result)>0){
$ipb_user=neutral_fetch_array($result);

if($ipb_user['member_login_key']==$$ext2cook){

$ipb_user['id']=(int)$ipb_user['id'];
$my_details['usr_id']=500000000+$ipb_user['id'];

$ipb_user['name']=convert_enc($ipb_user['name']);

$my_details['usr_name']=$ipb_user['name'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$ipb_user['time_offset'];


}}}

?>