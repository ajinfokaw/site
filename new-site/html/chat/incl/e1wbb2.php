<?php

if(isset($$ext1cook)&&isset($$ext2cook)){
$id=(int)$$ext1cook;
$query="SELECT userid,username,password,timezoneoffset FROM $ext1tble WHERE userid=$id";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){
$wbb_user=neutral_fetch_array($result);

if($wbb_user['password']==$$ext2cook){

$wbb_user['userid']=(int)$wbb_user['userid'];
$my_details['usr_id']=500000000+$wbb_user['userid'];

$wbb_user['username']=convert_enc($wbb_user['username']);

$my_details['usr_name']=$wbb_user['username'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$wbb_user['timezoneoffset'];


}}}

?>