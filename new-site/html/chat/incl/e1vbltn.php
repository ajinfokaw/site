<?php
$vB_licence_number='11111111';
$vb_user=array();

if(isset($$ext1cook)&&isset($$ext2cook)){
$cookie=(int)$$ext1cook;

$query="SELECT userid,username,password,timezoneoffset FROM $ext1tble WHERE userid=$cookie";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$vb_user=neutral_fetch_array($result);

if(md5($vb_user['password'].$vB_licence_number)==$$ext2cook){

$vb_user['userid']=(int)$vb_user['userid'];
$my_details['usr_id']=500000000+$vb_user['userid'];

$vb_user['username']=convert_enc($vb_user['username']);

$my_details['usr_name']=$vb_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$vb_user['timezoneoffset'];

}}}

?>