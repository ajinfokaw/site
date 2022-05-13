<?php

$query="SELECT * FROM $ext1tble WHERE user_id=$ajx_unfo";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$user=neutral_fetch_array($result);

print '<div class="s" style="float:right">e107</div>';

$name=output($user['user_name'],2);
$name=escape($name);
$name=convert_enc($name);

$loc=output($user['user_location'],2);
$loc=escape($loc);
$loc=convert_enc($loc);

print '<b>'.$name.'</b><br /><br />';

$zone=(int)$user['user_timezone'];
print $mdd.$lang['timezone'].': GMT';
if($zone>0){print '+';}
if($zone!=0){print $zone;}
print '<br />';

if(strlen($loc)>0){print $mdd.$lang['location'].': '.$loc.'<br />';}

$site=output($user['user_homepage'],2);$site=escape($site);
if(strlen($site)>0&&stristr($site,'http://')){print $mdd.$lang['website'].': <a style="text-decoration:none;font-weight:bold" href="info.php?reason=link" onclick="site=\''.$site.'\';window.open(site);return false">&raquo;&raquo;</a><br />';}

print '<br />';}
?>user_name