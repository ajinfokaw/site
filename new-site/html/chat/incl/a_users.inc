<?php
if(isset($from)){$from=(int)$from;}else{$from=0;}

$prt1=$from+1;$next=$from+10;$prt2=$next;
if($from<10){$prev=0;}else{$prev=$from-10;}

$where_clause='usr_id IS NOT NULL';

if(isset($src)){$src=trim($src);}else{$src='';}
if(strlen($src)>2){$src=output($src,2);
$src2db=neutral_escape($src,32,'str');}
else{$src='';$src2db='';}

if(strlen($src2db)>2){
$where_clause.=" AND (usr_name LIKE ('%$src2db%') OR usr_location LIKE ('%$src2db%') OR usr_info LIKE ('%$src2db%'))";}

if(isset($age)){
$age=(int)$age;$cyear=gmdate('Y',time());
switch($age){
case 1:$pp2=$cyear-12;$pp1=$cyear-20;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
case 2:$pp2=$cyear-20;$pp1=$cyear-30;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
case 3:$pp2=$cyear-30;$pp1=$cyear-40;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
case 4:$pp2=$cyear-40;$pp1=$cyear-50;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
case 5:$pp2=$cyear-50;$pp1=$cyear-60;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
case 6:$pp2=$cyear-60;$pp1=$cyear-99;$where_clause.=" AND usr_age BETWEEN $pp1 AND $pp2";break;
default:$where_clause.='';break;}}

if(isset($sex)){
$sex=(int)$sex;
switch($sex){
case 1:$where_clause.=" AND usr_sex=1";break;
case 2:$where_clause.=" AND usr_sex=2";break;
default:$where_clause.='';break;}}

if(isset($order)){$order=(int)$order;}
else{$order=6;} 

switch($order){
case 1:$oddr='usr_name asc';break;
case 2:$oddr='usr_name desc';break;
case 3:$oddr='usr_status asc';break;
case 4:$oddr='usr_status desc';break;
case 5:$oddr='usr_join_date asc';break;
case 6:$oddr='usr_join_date desc';break;
case 7:$oddr='usr_sex asc';break;
case 8:$oddr='usr_sex desc';break;
case 9:$oddr='usr_age asc';break;
case 10:$oddr='usr_age desc';break;
default:$oddr='usr_join_date desc';$order=6;break;}

if(stristr($db_type,'mysql')){$query='SELECT * FROM '.$prefix."_users WHERE $where_clause ORDER BY $oddr LIMIT $from,10";}
else{$query='SELECT * FROM '.$prefix."_users WHERE $where_clause ORDER BY $oddr LIMIT 10 OFFSET $from";}
$result=neutral_query($query);

$prtS='';
if(neutral_num_rows($result)>0){
$query='SELECT count(*) FROM '.$prefix."_users WHERE $where_clause";
$rows=neutral_query($query);$rows=neutral_fetch_array($rows);$rows=(int)$rows[0];

if($prt2>$rows){$prt2=$rows;}
$prtS=$prt1.'-'.$prt2.' ['.$rows.']';}



?>
<form id="fms" action="admin.php?q=users" method="post" style="margin:0px;padding:0px">

<div class="s">
<select class="s" style="width:100%" onchange="if(this.value!='a'){ss=confirm('<?php print $lang['confirm'];?>');if(ss){url='admin.php?mass='+this.value;go(url)}else{this.value='0'}}else{this.value='0'}">
<option value="0"><?php print $lang['mass'];?></option>
<option value="a"></option>
<option value="1">- <?php print $lang['all'].': ['.$lang['unverified'].' -&gt; '.$lang['activation'].']'; ?> -</option>
<option value="3">- <?php print $lang['all'].': ['.$lang['unverified'].' -&gt; '.$lang['delete'].']'; ?> -</option>
<option value="a"></option>
<option value="2">- <?php print $lang['all'].': ['.$lang['inactive'].' -&gt; '.$lang['activation'].']'; ?> -</option>
<option value="4">- <?php print $lang['all'].': ['.$lang['inactive'].' -&gt; '.$lang['delete'].']'; ?> -</option>
<option value="a"></option>
<option value="5">- <?php print $lang['all'].': ['.$lang['moderator'].' -&gt; '.$lang['user'].']'; ?> -</option>
<option value="6">- <?php print $lang['all'].': ['.$lang['clear_ban'].']'; ?> -</option>
<option value="a"></option>
</select><br />&nbsp;</div>

<div class="d" style="padding:1px"><div class="b">
<div style="float:left" class="u"><?php print $lang['users'];?></div>
<div style="float:right" class="s"><?php print '&nbsp;'.$prtS;?></div>
<br style="clear:both" />
</div></div>

<table style="width:100%" cellspacing="0">
<tr><td class="s" colspan="5">&nbsp;</td></tr>
<tr><td class="s">
<input type="text" class="s" style="width:50px" name="src" value="<?php print $src;?>" />
<input type="hidden" name="from" value="<?php print $from;?>" /></td>

<td class="s">
<select class="s" style="width:70px" name="sex">
<?php
print '<option value="0">'.$lang['sex'].'</option>';
if(isset($sex)&&$sex=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['male'].'</option>';
if(isset($sex)&&$sex=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$lang['female'].'</option>';
?>
</select></td>

<td class="s">
<select class="s" style="width:70px" name="age">
<?php
print '<option value="0">'.$lang['age'].'</option>';
if(isset($age)&&$age=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>12-20</option>';
if(isset($age)&&$age=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>20-30</option>';
if(isset($age)&&$age=='3'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="3"'.$sel.'>30-40</option>';
if(isset($age)&&$age=='4'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="4"'.$sel.'>40-50</option>';
if(isset($age)&&$age=='5'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="5"'.$sel.'>50-60</option>';
if(isset($age)&&$age=='6'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="6"'.$sel.'>60-&gt;</option>';
?>
</select></td>

<td class="s">
<select class="s" style="width:70px" name="order" onchange="if(this.value=='a'){this.value='0'}">
<?php
print '<option value="0">'.$lang['order'].'</option>';

print '<option value="a">------------</option>';

if(isset($order)&&$order=='1'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="1"'.$sel.'>'.$lang['name'].' &gt;</option>';
if(isset($order)&&$order=='2'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="2"'.$sel.'>'.$lang['name'].' &lt;</option>';

print '<option value="a">------------</option>';

if(isset($order)&&$order=='3'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="3"'.$sel.'>'.$lang['status'].' &gt;</option>';
if(isset($order)&&$order=='4'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="4"'.$sel.'>'.$lang['status'].' &lt;</option>';

print '<option value="a">------------</option>';

if(isset($order)&&$order=='5'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="5"'.$sel.'>'.$lang['join'].' &gt;</option>';
if(isset($order)&&$order=='6'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="6"'.$sel.'>'.$lang['join'].' &lt;</option>';

print '<option value="a">------------</option>';

if(isset($order)&&$order=='7'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="7"'.$sel.'>'.$lang['sex'].' &gt;</option>';
if(isset($order)&&$order=='8'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="8"'.$sel.'>'.$lang['sex'].' &lt;</option>';

print '<option value="a">------------</option>';

if(isset($order)&&$order=='9'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="9"'.$sel.'>'.$lang['age'].' &gt;</option>';
if(isset($order)&&$order=='10'){$sel=' selected="selected"';}else{$sel='';}
print '<option value="10"'.$sel.'>'.$lang['age'].' &lt;</option>';

?>
</select></td>

<td class="s" style="text-align:right"><input class="s" type="submit" value="<?php print $lang['ok'];?>" onclick="document.forms.fms.from.value=0" /></td>
</tr></table>

<?php
$mdd='<b>&middot;</b> ';
$no_results='<div class="s">&nbsp;</div><div class="d" style="padding:1px"><div class="c"><div class="s" style="padding:15px">'.$lang['no_results'].'</div></div></div>';

while($user=neutral_fetch_array($result)){
$usr_id=output($user['usr_id'],2);
$usr_id=(int)$usr_id;

$details='';

$avtr=output($user['usr_avatar'],2);
if(strlen($avtr)<5){$avtr='incl/no_pic.png';
$details.='<img src="'.$avtr.'" class="i" style="float:right;padding:1px;border:1px solid;width:80px;height:80px" alt="" />';}
else{$details.='<img src="'.$avtr.'" class="i" onclick="window.open(this.src)" style="float:right;padding:1px;border:1px solid;width:80px;height:80px" alt="'.$lang['open_new'].'" title="'.$lang['open_new'].'" />';}

$name=output($user['usr_name'],2);

$mod=output($user['usr_mod'],2);
if($user['usr_id']=='1'){$mod=' ['.$lang['admin'].']';}
elseif($mod=='1'){$mod=' ['.$lang['moderator'].']';}else{$mod='';}

$details.='<b>'.$name.'</b>'.$mod.'<br /><br />';

$mail=output($user['usr_mail'],2);
$details.=$mdd.'<a style="text-decoration:none" href="mailto:'.$mail.'"><b>'.$mail.'</b></a><br />';

$sex=(int)$user['usr_sex'];
switch($sex){
case 1:$details.=$mdd.$lang['sex'].': '.$lang['male'].'<br />';break;
case 2:$details.=$mdd.$lang['sex'].': '.$lang['female'].'<br />';break;}


switch($user['usr_status']){
case '0':$details.=$mdd.$lang['status'].': '.$lang['active'];break;
case '1':$details.=$mdd.$lang['status'].': '.$lang['inactive'];break;
default:$details.=$mdd.$lang['status'].': '.$lang['unverified'];break;}

if($user['usr_status']!='0'){
$details.='<br />&nbsp;&nbsp;(<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?activate='.$usr_id.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['activation'].'</a>)&nbsp;';
$details.='(<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?activate='.$usr_id.'\'+amp+\'email='.$mail.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['activation'].' &amp; '.$lang['mail'].'</a>)<br />';
}else{$details.='<br />';}

$age=(int)$user['usr_age'];
$cyear=gmdate('Y',time());$age=$cyear-$age;
if($age<100&&$age>11){$details.=$mdd.$lang['age'].': '.$age.'<br />';}

if(count($my_details)>0){
$tme=show_time($user['usr_join_date'],$my_details['usr_offset'],'Y-m-d H:i');
$details.=$mdd.$lang['join'].': '.$tme.'<br />';}

$zone=(int)$user['usr_offset'];
$details.=$mdd.$lang['timezone'].': GMT';
if($zone>0){$details.='+';}
if($zone!=0){$details.=$zone;}
$details.='<br />';

$loc=output($user['usr_location'],2);
if(strlen($loc)>0){$details.=$mdd.$lang['location'].': '.$loc.'<br />';}

$site=output($user['usr_website'],2);
if(strlen($site)>0){$details.=$mdd.$lang['website'].': <a style="text-decoration:none;font-weight:bold" href="info.php?reason=link" onclick="site=\''.$site.'\';window.open(site);return false">&raquo;&raquo;</a><br />';}

$details.='<br style="clear:both" /><br />';


$info=output($user['usr_info'],2);
if(strlen($info)>0){$details.=$info.'<br /><br />';}

print '<div class="s">&nbsp;</div><div class="d" style="padding:1px"><div class="c"><div class="s" style="padding:15px">'.$details.'<div class="s" style="text-align:right">';
if($usr_id>1){
if($user['usr_status']=='0'){
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?suspend='.$usr_id.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';go(lnk);return false">'.$lang['suspend'].'</a> <b>&middot;</b> ';
}
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?q=user\'+amp+\'uid='.$usr_id.'\';go(lnk);return false">'.$lang['edit'].'</a> <b>&middot;</b> ';
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?del_user='.$usr_id.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['delete'].'</a> <b>&middot;</b> ';
if($user['usr_mod']=='0'){
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?turn2mod='.$usr_id.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['user'].' -&gt; '.$lang['moderator'].'</a>';
}else{
print '<a href="info.php?reason=link" onclick="amp=\'&amp;\';lnk=\'admin.php?turn2usr='.$usr_id.'\'+amp+\'from='.$from.'\'+amp+\'order='.$order.'\';ss=confirm(\''.$lang['confirm'].'\');if(ss){go(lnk)};return false">'.$lang['moderator'].' -&gt; '.$lang['user'].'</a>';
}}

print '</div></div></div></div>';
$no_results='';
}
print $no_results;
?>

</form>
<div class="s" style="float:left"><b>
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=<?php print $prev;?>;f.submit();return false" style="text-decoration:none">&laquo;</a> 
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=0;f.submit();return false" style="text-decoration:none">1</a> &middot; 
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=10;f.submit();return false" style="text-decoration:none">2</a> &middot; 
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=20;f.submit();return false" style="text-decoration:none">3</a> &middot; 
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=30;f.submit();return false" style="text-decoration:none">4</a> &middot; 
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=40;f.submit();return false" style="text-decoration:none">5</a>
<a href="info.php?reason=link" onclick="f=document.forms.fms;f.from.value=<?php print $next;?>;f.submit();return false" style="text-decoration:none">&raquo;</a>
</b></div>