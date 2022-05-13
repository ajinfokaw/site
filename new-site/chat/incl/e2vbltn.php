<?php
$query="SELECT * FROM $ext1tble a,$ext2tble b WHERE a.userid=$ajx_unfo AND a.userid=b.userid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$user=neutral_fetch_array($result);

print '<div class="s" style="float:right">vBulletin</div>';

$name=output($user['username'],2);
$name=escape($name);
$name=convert_enc($name);

$loc=output($user['field2'],2);
$loc=escape($loc);
$loc=convert_enc($loc);

print '<b>'.$name.'</b><br /><br />';

$zone=(int)$user['timezoneoffset'];
print $mdd.$lang['timezone'].': GMT';
if($zone>0){print '+';}
if($zone!=0){print $zone;}
print '<br />';

$join=output($user['joindate'],2);$join=(int)$join;
$join=show_time($join,0,'Y-n-d');
print $mdd.$lang['join'].': '.$join.'<br />';

$site=output($user['homepage'],2);$site=escape($site);
if(strlen($site)>0&&stristr($site,'http://')){print $mdd.$lang['website'].': <a style="text-decoration:none;font-weight:bold" href="info.php?reason=link" onclick="site=\''.$site.'\';window.open(site);return false">&raquo;&raquo;</a><br />';}

if(strlen($loc)>0){print $mdd.$lang['location'].': '.$loc.'<br />';}


print '<br />';}
?>