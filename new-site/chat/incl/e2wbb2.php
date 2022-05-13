<?php

$query="SELECT * FROM $ext1tble WHERE userid=$ajx_unfo";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$user=neutral_fetch_array($result);

print '<div class="s" style="float:right">wbb2</div>';

$name=output($user['username'],2);
$name=escape($name);
$name=convert_enc($name);

print '<b>'.$name.'</b><br /><br />';

$zone=(int)$user['timezoneoffset'];
print $mdd.$lang['timezone'].': GMT';
if($zone>0){print '+';}
if($zone!=0){print $zone;}
print '<br />';

$sex=output($user['gender'],2);$sex=(int)$sex;
if($sex==1 || $sex==2){
if($sex==1){$sex=$lang['male'];}
if($sex==2){$sex=$lang['female'];;}
print $mdd.$lang['sex'].': '.$sex.'<br />';}

$site=output($user['homepage'],2);$site=escape($site);
if(strlen($site)>0&&stristr($site,'http://')){print $mdd.$lang['website'].': <a style="text-decoration:none;font-weight:bold" href="info.php?reason=link" onclick="site=\''.$site.'\';window.open(site);return false">&raquo;&raquo;</a><br />';}

print '<br />';}
?>
