<?php
require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($ajx_user)){die('1');} else{$ajx_user=(int)$ajx_user;}
if(!isset($ajx_sess)){die('2');}
if(!isset($ajx_code)){die('3');}

$check=hsh($ajx_user.$ajx_name.$ajx_sess);
if($ajx_code!=$check){die('4');}

if(($timestamp-$ajx_sess)>($session*3600)){
                      die('7');}

$query='SELECT * FROM '.$prefix."_banned WHERE ban_entry='$my_ip'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
                      die('8');}

if(!isset($ajx_unfo)){die('9');} else{$ajx_unfo=(int)$ajx_unfo;}

/* --- */

$mdd='<b>&middot;</b> ';

print '<div class="s">';
if($ajx_unfo<100000000){
$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$ajx_unfo";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$user=neutral_fetch_array($result);

$avtr=output($user['usr_avatar'],2);$avtr=escape($avtr);
if(strlen($avtr)<5){$avtr='incl/no_pic.png';
print '<img src="'.$avtr.'" class="i" style="float:right;padding:1px;border:1px solid;width:80px;height:80px" alt="" />';}
else{print '<img src="'.$avtr.'" class="i" onclick="window.open(this.src)" onload="tt=this.src;setInterval(\'this.src=tt\',5000)" style="float:right;padding:1px;border:1px solid;width:80px;height:80px" alt="'.$lang['open_new'].'" title="'.$lang['open_new'].'" />';}

$name=output($user['usr_name'],2);$name=escape($name);
print '<b>'.$name.'</b><br /><br />';

$sex=(int)$user['usr_sex'];
switch($sex){
case 1:print $mdd.$lang['sex'].': '.$lang['male'].'<br />';break;
case 2:print $mdd.$lang['sex'].': '.$lang['female'].'<br />';break;}

$age=(int)$user['usr_age'];
$cyear=gmdate('Y',time());$age=$cyear-$age;
if($age<100&&$age>11){print $mdd.$lang['age'].': '.$age.'<br />';}

$zone=(int)$user['usr_offset'];
print $mdd.$lang['timezone'].': GMT';
if($zone>0){print '+';}
if($zone!=0){print $zone;}
print '<br />';


$loc=output($user['usr_location'],2);$loc=escape($loc);
if(strlen($loc)>0){print $mdd.$lang['location'].': '.$loc.'<br />';}

$site=output($user['usr_website'],2);$site=escape($site);
if(strlen($site)>0){print $mdd.$lang['website'].': <a style="text-decoration:none;font-weight:bold" href="info.php?reason=link" onclick="site=\''.$site.'\';window.open(site);return false">&raquo;&raquo;</a><br />';}

print '<br style="clear:both" /><br />';


$info=output($user['usr_info'],2);$info=escape($info);
if(strlen($info)>0){print $info.'<br /><br />';}

}}

elseif($ajx_unfo>500000000 && isset($set_extn)){
$ajx_unfo=$ajx_unfo-500000000;
$set_extn=(int)$set_extn;
if($set_extn>0){
$ext=file('incl/extensions');
$ext=explode(':',$ext[$set_extn]);

$ext2file=trim($ext[2]);
$ext1tble=trim($ext[5]);
$ext2tble=trim($ext[6]);
include 'incl/'.$ext2file;
}}
print '</div>';

?>