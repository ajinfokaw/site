<?php 

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}


if(!isset($my_details['usr_mod'])||$my_details['usr_mod']!='1'){
redirect('info.php?reason=no_permission',0,0);}

/* --- */

include 'incl/open_doc.inc';

if(isset($ban)){
$ban=(int)$ban;

$usr_details=array();

$query='SELECT usr_ip FROM '.$prefix."_online WHERE usr_id=$ban";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){$ip=neutral_fetch_array($result);$ip=$ip[0];}
else{$ip='0';}

if($ip!='0'){
$query='SELECT ban_entry FROM '.$prefix."_banned WHERE ban_entry='$ip'";
$result=neutral_query($query);if(neutral_num_rows($result)>0){$ip='0';}}

if($ban<100000000){
$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$ban AND usr_status='0'";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){$usr_details=neutral_fetch_array($result);}}

print '<div style="padding:15px"><form action="ban.php" id="fms" method="post"><input type="hidden" name="process" value="1" />';
print '<table class="a" style="width:270px" cellspacing="1">';

if($ip!='0'&&$ip!=$my_ip){
print '<tr class="c"><td style="width:60%;padding:12px;text-align:right"><b>'.$ip.'</b>';
print '<br /><span class="s">'.$lang['ban_ip'].': </span></td>';
print '<td style="width:40%;padding:12px"><input type="hidden" name="ip" value="'.$ip.'" />';
print '<select class="s" style="width:100%" name="ban_stamp">';
print '<option value="0">'.$lang['6_hours'].'</option>';
print '<option value="1">'.$lang['a_day'].'</option>';
print '<option value="7">'.$lang['a_week'].'</option>';
print '<option value="30">'.$lang['a_month'].'</option>';
print '<option value="365">'.$lang['a_year'].'</option>';
print '</select></td></tr>';}
else{
print '<tr class="c"><td colspan="2" style="padding:12px;text-align:right">';
print '<span class="s">'.$lang['error_ip'].'</span></td></tr>';
}

if(count($usr_details)>0&&$usr_details['usr_id']!=$my_details['usr_id']&&$usr_details['usr_id']!='1'){

$id=(int)$usr_details['usr_id'];
$name=output($usr_details['usr_name'],2);

print '<tr class="c"><td style="width:60%;padding:12px;text-align:right"><b>'.$name.'</b>';
print '<br /><span class="s">'.$lang['suspend_acc'].': </span></td>';
print '<td style="width:40%;padding:12px"><select class="s" style="width:100%" name="id">';
print '<option value="'.$id.'">'.$lang['yes'].'</option>';
print '<option value="0" selected="selected">'.$lang['no'].'</option>';
print '</select></td></tr>';}
else{
print '<tr class="c"><td colspan="2" style="padding:12px;text-align:right">';
print '<span class="s">'.$lang['error_usr'].'</span></td></tr>';
}
print '<tr class="c"><td colspan="2" style="padding:12px;text-align:right"><input type="submit" value="'.$lang['ok'].'" /></td></tr>';

print '</table></form></div>';
}
elseif(isset($process)){

if(isset($ip)){$ip=neutral_escape($ip,15,'str');}else{$ip='0';}
if(isset($id)){$id=(int)$id;}else{$id='0';}

if($ip=='0'&&$id=='0'){print '<script type="text/javascript">self.close();</script>';}

if($ip!='0'&&$ip!=$my_ip){

if(isset($ban_stamp)){$ban_stamp=(int)$ban_stamp;}else{$ban_stamp=0;}
if($ban_stamp<1){$ban_stamp=6*3600;}else{$ban_stamp=$ban_stamp*24*3600;}
$ban_stamp=$timestamp+$ban_stamp;

$query='INSERT INTO '.$prefix."_banned VALUES('$ip',$ban_stamp)";
neutral_query($query);}

if($id>1){
$usr_details=array();
$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$id";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){$usr_details=neutral_fetch_array($result);}

if(count($usr_details)>0&&($usr_details['usr_mod']=='0'||$my_details['usr_id']=='1')){
$query='UPDATE '.$prefix."_users SET usr_status='1' WHERE usr_id=$id";
neutral_query($query);}}

print '<div class="s" style="padding:10px">DONE</div>';
print '<script type="text/javascript">setTimeout(\'self.close()\',2000);</script>';
}

?>
</body></html>